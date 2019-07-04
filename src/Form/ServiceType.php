<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre'
            ])
            ->add('contenu')
            ->add('url_img', FileType::class, [
                'label' => 'Images (jpg, png)',
                'data_class' => null,
                'attr' => ['class'=> 'Fichier']
            ])
            ->add('visible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
