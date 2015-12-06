<?php

namespace Mert\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
}
