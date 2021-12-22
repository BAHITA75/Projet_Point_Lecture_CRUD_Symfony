<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label'=>'Nom',
            'attr'=>['placeholder' => 'Entre votre nom']
        ])
        ->add('lastname', TextType::class, [
            'label'=>'Prénom',
            'attr'=>['placeholder' => 'Entre votre prénom'] 
        ])
        ->add('email', EmailType::class, [                                      
            'required' => true,                             
            'attr'=>['placeholder' => 'Entre votre adresse mail']
        ])   
        ->add('password', PasswordType::class, [                               
            'label'=>'Mot de passe',
            'required' => true,                             
            'attr'=>['placeholder' => 'Entre votre mot de passe']
        ])  
        ->add('submit', SubmitType::class, [
            'label'=>'S\'enregistrer',
            'attr'=>['class'=>'btn btn-primary d-block my-4 mx-auto col-4']
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
