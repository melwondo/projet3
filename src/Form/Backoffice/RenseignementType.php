<?php

namespace App\Form\Backoffice;

use App\Entity\Renseignement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('pro', null, [
                'label_attr'=> array('class'=> 'custom-control-label'),
            ])
            ->add('entreprise')
            ->add('message')
            ->add('dateMessage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Renseignement::class,
        ]);
    }
}
