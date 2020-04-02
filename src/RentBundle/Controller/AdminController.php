<?php

namespace RentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function dashAction(Request $request)
    {

        return $this->render('default:dashebord-base.html.twig') ;
    }
}
