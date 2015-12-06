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

    public function changeTicketStatus($ticket, $status) {

        $qb = $this->getEntityManager()->createQueryBuilder();
        $q = $qb->update('MertTicketBundle:Ticket', 't')
            ->set('t.is_solved', $qb->expr()->literal($status))
            ->where('t.id = ?1')
            ->setParameter(1, $ticket->getId())
            ->getQuery();
        $p = $q->execute();

        return $p;
    }

    /**
     * @return array
     * Overriding findAll
     */
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
}