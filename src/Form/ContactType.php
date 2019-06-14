<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('tel')
            ->add('rue')
            ->add('CP')
            ->add('ville')
            ->add('entreprise')
            ->add('pro')
        ;
    }

    // ->add('messages', MessageType::class,[
    //     'class' => Message::class,
    //     ])

    // ->add('messages', CollectionType::class, array(
    //     'entry_type' => MessageType::class
    // ));
  
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
