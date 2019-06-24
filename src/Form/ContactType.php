<?php

namespace App\Form;

use App\Entity\ContactSimple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('sujet')
            ->add('meassage')
            ->add('pro')
            ->add('entreprise', null, [
                'label_attr'=> array('style'=>'visibility:hidden'),
                'attr'=> array('style'=>'visibility:visibility')
            ])
            ->add('rue')
            ->add('cp')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactSimple::class,
        ]);
    }
}
