<?php

namespace App\Form;

use App\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'input name',
                    'placeholder' => 'Enter team name...'
                ),
                'label' => false
            ])
            ->add('country', TextType::class, [
                'attr' => array(
                    'class' => 'input',
                    'placeholder' => 'Enter team country...'
                ),
                'label' => false
            ])
            ->add('moneyBalance', NumberType::class, [
                'attr' => array(
                    'class' => 'input name',
                    'placeholder' => 'Enter money balance...'
                ),
                'label' => false
            ])
            ->add('players', CollectionType::class, [
                'entry_type' => PlayerFormType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
