<?php

namespace App\Form;

use App\Service\TeamService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransferFormType extends AbstractType
{
    public function __construct(private TeamService $teamService)
    {
       
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('team1', ChoiceType::class, [
                $this->teamService->getAllTeams()
            ])
            ->add('team2', ChoiceType::class, [
                $this->teamService->getAllTeams()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
