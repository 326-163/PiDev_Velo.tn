<?php

namespace CircuitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CircuitBundle:Default:index.html.twig');
    }
}
