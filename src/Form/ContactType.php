<?php

namespace App\Form;

use App\Entity\ContactSimple;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pro', null, [
                'label_attr'=> array('class'=> 'custom-control-label'),
            ])
            ->add('entreprise')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('sujet')
            ->add('message')
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
