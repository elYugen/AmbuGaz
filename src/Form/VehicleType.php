<?php

namespace App\Form;

use App\Entity\Vehicle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('license_plate', TextType::class, [
                'label' => 'Plaque d\'immatriculation',
                'attr' => ['placeholder' => 'AB-123-CD'],
            ])
            ->add('model', TextType::class, [
                'label' => 'Modèle',
                'attr' => ['placeholder' => 'Ex: Renault Master'],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du véhicule',
                'attr' => ['placeholder' => 'Ex: Ambulance 1'],
            ])
            ->add('year_of_service', IntegerType::class, [
                'label' => 'Année de mise en service',
                'attr' => ['placeholder' => date('Y')],
            ])
            ->add('technical_inspection_date', DateType::class, [
                'label' => 'Date du contrôle technique',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('insurance_date', DateType::class, [
                'label' => 'Date d\'assurance',
                'widget' => 'single_text',
                'required' => false,
            ])
            // Le champ 'company' est volontairement omis pour des raisons de sécurité
            // L'entreprise est automatiquement assignée dans le controller
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
