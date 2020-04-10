<?php

namespace RentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function homeAction(Request $request)
    {

        return $this->render('RentBundle:admin:dashebord.html.twig') ;
    }

    public function locationAction(Request $request)
    {

        return $this->render('RentBundle:admin:location.html.twig') ;
    }

    public function reservationAction(Request $request)
    {

        return $this->render('RentBundle:admin:reservation.html.twig') ;
    }
}
