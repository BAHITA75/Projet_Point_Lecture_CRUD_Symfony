<?php

namespace App\Form;

use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
             ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'lastname',
                'label' => 'Entrez le prenom du lecteur',
            ])
            ->add('livre', EntityType::class, [
                'class' => Livre::class,
                'choice_label' => 'name',
                'label' => 'Entrez le titre du livre',
            ])
            ->add('dateRetour', DateType::class, [
                'label'=>'Date de retour',
                'required' => true,
                'attr'=>['placeholder' => 'Entrez la date de retour']
            ])
            ->add('submit', SubmitType::class, [
                'label'=>'Ajouter',
                'attr'=>['class'=>'btn btn-primary d-block mx-auto mt-4 col-4']
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
