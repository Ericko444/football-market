<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\Team;
use App\Form\TeamFormType;
use App\Repository\TeamRepository;
use App\Service\PlayerService;
use App\Service\TeamService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TeamController extends AbstractController
{
    public function __construct(private TeamService $teamService, private PlayerService $playerService, private EntityManagerInterface $em)
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

    #[Route('/team/transfer', name: 'players_transfer')]
    public function transfer(Request $request): Response
    {
        return $this->render('teams/transfer.html.twig', ['teams' => $this->teamService->getAllTeams()]);
    }

    #[Route('/team/players/{id}', name: 'players')]
    public function getPlayers($id, Request $request)
    {
        $players = $this->teamService->getPlayers($id);
        $jsonData = array();
        $idx = 0;
        foreach($players as $player) {
            $temp = array(
               'id' => $player->getId(),
               'name' => $player->getName(),
               'surname' => $player->getSurname(),
               'marketValue' => $player->getMarketValue(),
            );
            $jsonData[$idx++] = $temp;
        }
        return new JsonResponse($jsonData);
    }

    #[Route('/team/transfer/validate', name: 'validate_transfer')]
    public function validateTransfer(Request $request)
    {
        $jsonData = json_decode($request->getContent(), true);
        // dd($jsonData);
        $player = $this->playerService->getPlayer($jsonData['player']);
        $amount = floatval($jsonData['price']);
        $teamTarget = $this->teamService->findTeam($jsonData['team']);

        try{
            $this->teamService->transferPlayer($player, $teamTarget, $amount);
            $this->em->flush();
            return new JsonResponse([
                'success' => true,
                'message' => 'Transfer successful.',
            ]);
        }
        catch(Exception $err){
            return new JsonResponse([
                'success' => false,
                'message' => $err->getMessage(),
            ]);
        }
        
    }
}
