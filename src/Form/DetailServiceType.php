<?php

namespace App\Form;

use App\Entity\DetailService;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $option)
    {
        $builder
            ->add('titre')
            ->add('subtitle')
            ->add('contenu')
            ->add('url_img', FileType::class ,[
                'label' => 'Image (jpg png)',
                'mapped' => true,
                'required' => true,
                'data_class' => null])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'multiple' => false,
                'expanded' => false,
                'by_reference' => true,
                'choice_label' => 'titre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailService::class,
        ]);
    }
}
