<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 02/05/2019
 * Time: 10:47
 */// src/Controller/ContactController.php
namespace App\Controller;

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
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        // Action quand formulaire soumis et si données valides (respect selon le ContactType).
        if ($form->isSubmitted() && $form->isValid()) {

            $departementSelected = $form->get('departement')->getData()->getId();


            $adresses = $this->responsableRepository->findByDepartmentId($departementSelected);


            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash('notice', 'mail bien envoyé.');
            return $this->redirectToRoute('form_index');
        }
        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}