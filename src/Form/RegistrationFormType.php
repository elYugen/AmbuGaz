<?php
// src/Form/RegistrationFormType.php

namespace App\Form;

use App\Entity\Company;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new Assert\NotBlank(message: 'Email requis'),
                    new Assert\Email(message: 'Email invalide'),
                ],
            ])
            ->add('firstName', TextType::class, [  // 👈 Changé de first_name
                'label' => 'Prénom',
                'constraints' => [
                    new Assert\NotBlank(message: 'Prénom requis'),
                ],
            ])
            ->add('lastName', TextType::class, [  // 👈 Changé de last_name
                'label' => 'Nom',
                'constraints' => [
                    new Assert\NotBlank(message: 'Nom requis'),
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new Assert\NotBlank(message: 'Téléphone requis'),
                ],
            ])
            ->add('company', EntityType::class, [  // 👈 Nom du champ dans le formulaire
                'label' => 'Entreprise',
                'class' => Company::class,
                'choice_label' => 'name',
                'placeholder' => 'Sélectionnez une entreprise',
                'constraints' => [
                    new Assert\NotBlank(message: 'Entreprise requise'),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmer le mot de passe'],
                'constraints' => [
                    new Assert\NotBlank(message: 'Mot de passe requis'),
                    new Assert\Length(
                        min: 8, 
                        minMessage: 'Le mot de passe doit contenir au moins 8 caractères'
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
