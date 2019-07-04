<?php

namespace App\Form;

use App\Entity\Renseignement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RenseignementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('rue')
            ->add('cp')
            ->add('ville')
            ->add('pro')
            ->add('entreprise', null, [
                'attr' => array('style' => 'display:none'),
                'label' => false,
            ])
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Renseignement::class,
        ]);
    }
}
