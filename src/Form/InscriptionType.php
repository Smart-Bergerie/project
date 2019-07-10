<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class,[

            ])
            ->add('Prenom', TextType::class,[

            ])
            ->add('Sexe', ChoiceType::class,[
                'choices' => $this->getChoice(),

            ])
            ->add('Username', TextType::class,[

            ])
            ->add('Password', PasswordType::class,[

                'attr' =>[
                    'id' => 'pass-status'
                ]
            ])
            ->add('confirm_password', PasswordType::class,[

                'attr' =>[
                    'id' => 'inputConfirmPassword'
                ]
            ])
            ->add('Telephone', TextType::class,[

            ])
            ->add('Email', EmailType::class,[

            ])
            ->add('Telephone', TextType::class,[

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

    private function getChoice(): array
    {
        $choices = Users::SEXE;
        $outpout= [];
        foreach ($choices as $k => $v){
            $outpout[$v] = $k;
        }
        return $outpout;
    }
}
