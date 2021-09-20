<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if(in_array('ROLE_SUPER_ADMIN', $options['role']))
            $auth = [
                'Super Amministratore' => 'ROLE_SUPER_ADMIN',
                'Amministratore' => 'ROLE_ADMIN',
                'Utente Standard' => 'ROLE_ACCOUNT'
            ];
        elseif (in_array('ROLE_ADMIN', $options['role']))
            $auth = [
                'Amministratore' => 'ROLE_ADMIN',
                'Utente Standard' => 'ROLE_ACCOUNT'
            ];
        else
            $auth = [];

        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Nome'
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Cognome'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => 'Password',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Inserisci una password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'La tua password deve avere almeno {{ limit }} caratteri',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    $auth
                ],
                'label' => 'Permessi utente',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salva',
                'attr' => [
                    'class' => 'btn btn-primary float-right'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'role' => ['ROLE_USER'],
        ]);
    }
}
