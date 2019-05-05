<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 05/05/2019
 * Time: 17:48
 */

namespace App\Form;

use App\Entity\Departement;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', TextType::class, array(
                'required' => true,
                'label' => 'Prénom :',
            ))
            ->add('nom', TextType::class, array(
                'required' => true,
                'label'    => 'Nom :',
            ))
            ->add('email', EmailType::class, array(
                'required' => true,
                'label'    => 'E-mail :',
            ))
            ->add('message', TextareaType::class, array(
                'required' => true,
                'label'    => 'Message :',
            ))
            ->add('departement', EntityType::class, array(
                'class' => Departement::class,
                'query_builder' => function (EntityRepository $repository) {
                    return $repository->createQueryBuilder('d')
                        ->orderBy('d.id', 'ASC');
                },
                'choice_label' => 'designation',
                'mapped'       => false,
                'label'        => 'Département :'
            ))
            ->add('send', SubmitType::class, array('label' => 'Envoyer'))
        ;
    }
}
