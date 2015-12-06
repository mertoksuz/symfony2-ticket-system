<?php

namespace Mert\TicketBundle\Controller;

use Mert\TicketBundle\Entity\Ticket;
use Mert\TicketBundle\Form\TicketType;
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

        $entityManager = $this->getDoctrine()->getManager();
        $ticket = new Ticket();
        $form = $this->createForm(new TicketType(), $ticket);

        $form->handleRequest($request);



        if ($request->isMethod('POST')) {

                $user = $this->get('security.token_storage')->getToken()->getUser();
                //$ticket->upload();
                $ticket->setUser($user);
                //$ticket->setCategory($request->get('category'));
                $entityManager->persist($ticket);
                $entityManager->flush();

                $this->redirectToRoute("ticket_list");

        }

        $returnData = [
            'categories' => $entityManager->getRepository("MertTicketBundle:Category")->findAll(),
            'form' => $form->createView()
        ];

        return $this->render('MertTicketBundle:Ticket:add.html.twig', $returnData);
    }
}
