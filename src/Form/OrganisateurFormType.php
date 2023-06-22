<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Organisateur;

class OrganisateurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Type :',
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => 'Civilité :',
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                ],
            ])
            ->add('cin', TextType::class, [
                'label' => 'CIN :',
            ])
            ->add('codePostale', TextType::class, [
                'label' => 'Code Postal :',
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Organisateur::class,
        ]);
    }
}

