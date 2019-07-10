<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReinitialiserMdpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Password', PasswordType::class,[
                'required' => true,
                'attr'=>[
                    'placeholder' => 'Nouveau mot de passe'
                ]
            ])
            ->add('confirm_password',PasswordType::class,[
                'required' => true,
                'label' => 'Confirmation mot de passe',
                'attr'=>[
                    'placeholder' => 'Confirmer votre mot de passe'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'translation_domain' => 'forms'
        ]);
    }
}
