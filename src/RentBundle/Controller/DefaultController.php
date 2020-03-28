<?php

namespace RentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RentBundle:Default:index.html.twig');
    }

    public function dashboardAction(Request $request)
    {

        return $this->render('AppBundle:dashebord-base.html.twig',array (

        ));
    }
}
