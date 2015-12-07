<?php

namespace Mert\TicketBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="user_id")
     */
    protected $user_tickets;

    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Add userTicket
     *
     * @param \Mert\TicketBundle\Entity\Ticket $userTicket
     *
     * @return User
     */
    public function addUserTicket(\Mert\TicketBundle\Entity\Ticket $userTicket)
    {
        $this->user_tickets[] = $userTicket;

        return $this;
    }

    /**
     * Remove userTicket
     *
     * @param \Mert\TicketBundle\Entity\Ticket $userTicket
     */
    public function removeUserTicket(\Mert\TicketBundle\Entity\Ticket $userTicket)
    {
        $this->user_tickets->removeElement($userTicket);
    }

    /**
     * Get userTickets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserTickets()
    {
        return $this->user_tickets;
    }
}
