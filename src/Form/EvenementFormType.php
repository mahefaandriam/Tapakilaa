<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('type', ChoiceType::class, [
                'label' => 'Type :',
                'choices' => [
                    'Spectacle' => 'spectacle',
                    'Sports' => 'sports',
                    'Concerts' => 'concerts',
                    'Loisirs' => 'loisirs',
                    'Théâtre' => 'theatre',
                    'Cinéma' => 'cinema',
                    'Conférence' => 'conference',
                    'Cours' => 'cours',
                ],
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu :',
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville :',
            ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date de début :', // Ajoutez ici le libellé approprié
            ])
            ->add('dateFin', DateTimeType::class)
            ->add('description', TextareaType::class)
            ->add('image', FileType::class, [
                'required' => false,
                'data_class' => null,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}


