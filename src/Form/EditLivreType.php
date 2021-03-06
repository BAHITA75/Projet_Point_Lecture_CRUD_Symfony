<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditLivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label'=>'Titre',
            'required' => true, 
            'attr'=>['placeholder' => 'Entre le titre']
        ])
        ->add('auteur', TextType::class, [
            'label'=>'auteur',
            'required' => true,
            'attr'=>['placeholder' => 'Entre l\'auteur']
        ])
        ->add('description', TextareaType::class, [
            'label'=>'Description',
            'required' => true,
            'attr'=>['placeholder' => 'Entre la description']
        ])
        ->add('annee_edition', TextType::class, [
            'label'=>'année d\'edition',
            'required' => true,
            'attr'=>['placeholder' => 'Entre l\'année d\'edition']
        ])
        ->add('picture', TextType::class, [
            'label'=>'Photo',
            'required' => true,
            'attr'=>['placeholder' => 'Entre une illustration']
        ])
        ->add('submit', SubmitType::class, [
            'label'=>'Modifier',
            'attr'=>['class'=>'btn btn-primary']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
