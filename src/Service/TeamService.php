<?php

namespace App\Service;

use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class TeamService
{
    public function __construct(
        private RequestStack $requestStack,
        private PaginatorInterface $paginator,
        private TeamRepository $teamRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function getTeamsPagination()
    {
        $request = $this->requestStack->getMainRequest();
        $dql = "SELECT t FROM App\Entity\Team t";
        $query = $this->em->createQuery($dql);

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $pagination;
    }

    public function getAllTeams()
    {
        return $this->teamRepository->findAll();
    }

    public function getPlayers($teamId)
    {
        $team = $this->teamRepository->find($teamId);
        if (!is_null($team)) {
            return $team->getPlayers();
        } else {
            throw new Exception("Team not found");
        }
        return;
    }

    public function findTeam($id)
    {
        return $this->teamRepository->find($id);
    }

    public function transferPlayer($player, $teamTarget, $amount)
    {
        $playerTeam = $player->getTeam();

        if ($teamTarget->getMoneyBalance() - $amount > 0) {
            $playerTeam->setMoneyBalance($playerTeam->getMoneyBalance() + $amount);
            $teamTarget->setMoneyBalance($teamTarget->getMoneyBalance() - $amount);
            $playerTeam->removePlayer($player);
            $teamTarget->addPlayer($player);
        } else {
            throw new Exception("Transfer is not executable");
        }
    }

}
