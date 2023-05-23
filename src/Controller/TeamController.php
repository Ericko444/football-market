<?php

namespace App\Controller;

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
    public function __construct(private TeamService $teamService)
    {
       
    }

    #[Route('/', name: 'app_teams')]
    public function index(Request $request): Response
    {
        return $this->render('teams/index.html.twig', ['pagination' => $this->teamService->getTeamsPagination()]);
    }
}
