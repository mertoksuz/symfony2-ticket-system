<?php

namespace Mert\TicketBundle\Controller;

use Mert\TicketBundle\Entity\Comment;
use Mert\TicketBundle\Entity\Ticket;
use Mert\TicketBundle\Form\CommentType;
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
    public function listAction(Request $request) {

        $entityManager = $this->getDoctrine()->getManager();


        if ($request->isMethod('POST')) {
            $searchArray = [];
            if (!empty($request->get('category'))) {
                $searchArray['category'] = $request->get('category');
            }
            if (!empty($request->get('title'))) {
                $searchArray['title'] = $request->get('title');
            }
            if (!empty($request->get('priority'))) {
                $searchArray['priority'] = $request->get('priority');
            }
            if (!empty($request->get('created'))) {
                $searchArray['created_at'] = $request->get('created');
            }
        }

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $searchArray['user'] = $user->getId();
        }

        if (!empty($searchArray)) {
            $getMyTickets = $entityManager->getRepository("MertTicketBundle:Ticket")->findBy($searchArray);
        }
        else {
            $getMyTickets = $entityManager->getRepository("MertTicketBundle:Ticket")->findAll();
        }



        $categories = $entityManager->getRepository("MertTicketBundle:Category")->findAll();

        $returnData = [
            'tickets' => $getMyTickets,
            'categories' => $categories
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

                $this->get('session')->getFlashBag()->add('ticket_notice', 'Thank you ! Your ticket opened at '.date('d-m-Y H:i:s', time()).'. We will contact to you as soon.');


                $this->redirectToRoute("ticket_list");

        }

        $returnData = [
            'categories' => $entityManager->getRepository("MertTicketBundle:Category")->findAll(),
            'form' => $form->createView()
        ];

        return $this->render('MertTicketBundle:Ticket:add.html.twig', $returnData);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/tickets/{ticket}/changestatus/{status}", name="tickets_change_status")
     *
     */
    public function changeStatusAction(Ticket $ticket, $status) {

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->getRepository("MertTicketBundle:Ticket")->changeTicketStatus($ticket, $status);

            $this->get('session')->getFlashBag()->add('ticket_notice', 'Ticket status changed.');

            return $this->redirectToRoute("ticket_list");

        } else {
            return $this->redirectToRoute("main_page");
        }


    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/tickets/{ticket}/comment", name="tickets_add_comment")
     */
    public function commentAction(Ticket $ticket, Request $request) {

        $entityManager = $this->getDoctrine()->getManager();
        $ticket = $entityManager->getRepository("MertTicketBundle:Ticket")->find($ticket);
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $entityManager->persist($comment);
                $entityManager->flush();

                $this->get('session')->getFlashBag()->add('comment_notice', 'Comment added.');

                return $this->redirectToRoute("tickets_add_comment", array('ticket' => $ticket->getId()));

            }

        }

        $returnData = [
            'ticket' => $ticket,
            'form' => $form->createView()
        ];

        return $this->render("@MertTicket/Ticket/comment.html.twig", $returnData);
    }

}
