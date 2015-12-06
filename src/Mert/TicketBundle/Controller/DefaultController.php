<?php

namespace Mert\TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MertTicketBundle:Default:index.html.twig', array('name' => $name));
    }
}
