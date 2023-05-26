<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PlayerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'input',
                    'placeholder' => 'Enter player name...'
                ),
                'label' => false
            ])
            ->add('surname', TextType::class, [
                'attr' => array(
                    'class' => 'input',
                    'placeholder' => 'Enter player surname...'
                ),
                'label' => false
            ])
            ->add('marketValue', NumberType::class, [
                'attr' => array(
                    'class' => 'input',
                    'placeholder' => 'Enter player market value...'
                ),
                'label' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
