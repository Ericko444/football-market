<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Form\TeamFormType;
use App\Repository\TeamRepository;
use App\Service\TeamService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

class TeamController extends AbstractController
{
    public function __construct(private TeamService $teamService, private EntityManagerInterface $em,)
    {
       
    }

    #[Route('/', name: 'app_teams')]
    public function index(Request $request): Response
    {
        return $this->render('teams/index.html.twig', ['pagination' => $this->teamService->getTeamsPagination()]);
    }

    #[Route('/team/create', name: 'create_team')]
    public function create(Request $request): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamFormType::class, $team);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newTeam = $form->getData();
            
            $this->em->persist($newTeam);
            $this->em->flush();

            return $this->redirectToRoute('app_teams');
        }

        return $this->render('teams/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
