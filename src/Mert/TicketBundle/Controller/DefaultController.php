<?php

namespace Mert\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/", name="main_page")
     */
    public function indexAction()
    {
        return $this->render('MertTicketBundle:Ticket:index.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/tickets", name="ticket_list")
     */
    public function listAction() {

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $getMyTickets = $entityManager->getRepository("MertTicketBundle:Ticket")->findBy(array('user' => $user));

        $returnData = [
            'tickets' => $getMyTickets
        ];

        return $this->render('MertTicketBundle:Ticket:list.html.twig', $returnData);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/tickets/add", name="ticket_add")
     */
    public function addAction(Request $request) {

        return $this->render('MertTicketBundle:Ticket:add.html.twig');
    }
}
