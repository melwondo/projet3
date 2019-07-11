<?php

namespace App\Form;

use App\Entity\DetailService;
use App\Entity\Service;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DetailServiceEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {

        $builder
            ->add('titre')
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre',
                'required'=>false,
            ])
            ->add('contenu')
            ->add('UrlImg', FileType::class, [
                'label' => 'Image (jpg, png)',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
            ])
            ->add('service', EntityType::class, [
                'class' => Service::class,
                'multiple' => false,
                'expanded' => false,
                'by_reference' => true,
                'choice_label' => 'titre'
            ])
            ->add('visible')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetailService::class,
        ]);
    }
}
