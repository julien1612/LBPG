<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    // ... imports (TextType, EmailType, ChoiceType, TextareaType...)

public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('prenom', TextType::class, [
            'label' => 'Prénom *',
            'attr' => ['placeholder' => 'Saisissez votre prénom']
        ])
        ->add('nom', TextType::class, [
            'label' => 'Nom *',
            'attr' => ['placeholder' => 'Saisissez votre nom']
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email *',
            'attr' => ['placeholder' => 'Saisissez votre adresse mail']
        ])
        ->add('vous_etes', ChoiceType::class, [
            'label' => 'Vous êtes *',
            'choices' => [
                'Un particulier' => 'un particulier',
                'Un professionnel' => 'un professionnel',
                'Une association' => 'une association',
            ],
            'placeholder' => 'Vous êtes',
        ])
        ->add('message', TextareaType::class, [
            'label' => 'Message *',
            'attr' => ['placeholder' => 'Saisissez votre message', 'rows' => 5]
        ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
