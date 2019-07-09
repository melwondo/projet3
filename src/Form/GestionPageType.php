<?php

namespace App\Form;

use App\Entity\GestionPage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GestionPageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Image', FileType::class, [
                'label' => 'Image (jpg, png)',
                'required' => true,
                'mapped' => true,
                'data_class' => null,
                ])
            ->add('Contenu')
            ->add('PageAssociee', ChoiceType::class, [
                'choices'  => [
                    'Accueil' => 'Accueil',
                    'Services' => 'Services',
                    'Partenaires' => 'Partenaires',
                    'Contact' => 'Contact',
                    'Sous Services'=> 'SousService'
                    ],
                ])
            ->add('Visible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GestionPage::class,
        ]);
    }
}
