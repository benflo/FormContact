<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 02/05/2019
 * Time: 10:47
 */// src/Controller/ContactController.php
namespace App\Controller;

use App\Service\MailGenerator;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ResponsableRepository;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route as Route;

class ContactController extends AbstractController
{
    /** @var ResponsableRepository $responsableRepository */
    private $responsableRepository;

    /**
     * ContactController constructor.
     *
     * @param ResponsableRepository $responsableRepository
     */
    public function __construct(ResponsableRepository $responsableRepository)
    {
        $this->responsableRepository = $responsableRepository;
    }

    /**
     * @Route("/contact/form", name="form_index")
     */
    public function new(Request $request, MailGenerator $mailGenerator, \Swift_Mailer $mailer)
    {
        // creates a task and gives it some dummy data for this example
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        // Action quand formulaire soumis et si données valides (respect selon le ContactType).
        if ($form->isSubmitted() && $form->isValid()) {

            // 1. récupérer la valeur du input departement
            $departementSelected = $form->get('departement')->getData()->getId();

            // 2. Récupérer le ou les courriels du département associé au département sélectionné dans le formulaire
            $adresses = $this->responsableRepository->findByDepartmentId($departementSelected);

            $message = (new \Swift_Message($contact))
                ->setFrom($departementSelected['email'])
                ->setTo('recipient@example.com')
                ->setBody(
                    $this->renderView(
                        'contact/form.html.twig', [
                            'form' => $form->createView() ]
                    )
                )
            ;
            $mailer->send($message);
            //3.Essayer d'envoyer le / les courriel(s) depuis un service dédié si réussite, message disant "youpi" + sauvegarde message objet Contact en BDD sinon, erreur système "Une erreur est survenue durant le processus, Si cela se produit de nouveau, merci de contacter l'administrateur."
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $message = $mailGenerator->getHappyMessage();
            $this->addFlash('notice', $message);
            return $this->redirectToRoute('form_index');
        }
        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}