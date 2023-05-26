<?php

namespace App\Service;

use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PlayerService
{
    public function __construct(
        private RequestStack $requestStack,
        private PaginatorInterface $paginator,
        private PlayerRepository $playerRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function getPlayer($id)
    {
        return $this->playerRepository->find($id);
    }
}
