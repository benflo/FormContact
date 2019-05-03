<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 02/05/2019
 * Time: 10:47
 */// src/Controller/ContactController.php
namespace App\Controller;

use App\Entity\Contact;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact/form", name="form_index")
     */
    public function new(Request $request)
    {

        // creates a task and gives it some dummy data for this example
        $contact = new Contact();
        $contact->setNom('nom');
        $contact->setPrenom('prenom');
        $contact->setMail('mail');
        $contact->setMessage('message');

        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('mail', TextType::class)
            //->add('departement',ChoiceType::class)
            ->add('message', TextareaType::class)
            ->add('save', SubmitType::class, ['label' => 'Envoyer mail'])
            ->getForm();

            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes

            if ($form->isSubmitted() && $form->isValid()) {

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
