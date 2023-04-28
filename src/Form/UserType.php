<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('first_name', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Nom'
            ])
        ;

        if ($options['help'] == "app_user_new") {
            $builder
                ->add('password', TextType::class, [
                    'label' => 'Mot de passe'
                ])
            ;
        }

        $builder
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                    'Utilisateur' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Super-Admin' => 'ROLE_SUPER_ADMIN',
                ],
            ])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
