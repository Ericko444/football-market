<?php

namespace App\Service;

use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $dql   = "SELECT t FROM App\Entity\Team t";
        $query = $this->em->createQuery($dql);

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10 
        );

        return $pagination;
    }

}
