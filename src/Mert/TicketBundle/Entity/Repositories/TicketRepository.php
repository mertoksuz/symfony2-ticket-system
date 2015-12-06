<?php
namespace Mert\TicketBundle\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    public function findAllOrderedByCreated($userId)
    {

        $query = $this->createQueryBuilder('t')
            ->where('t.user = '.$userId)
            ->orderBy('t.createdAt', 'desc')
            ->getQuery()->getResult();

        return $query;
    }
}