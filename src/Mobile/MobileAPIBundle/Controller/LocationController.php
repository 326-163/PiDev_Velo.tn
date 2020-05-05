<?php


namespace Mobile\MobileAPIBundle\Controller;

use Mobile\MobileAPIBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class LocationController extends Controller
{

    public function allAction ()
    {
        $locations = $this->getDoctrine()->getManager()
            ->getRepository('MobileAPIBundle:Location')
            ->findAll();
        $serializer = new Serializer ([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($locations);
        return new JsonResponse($formatted);

    }

    public function findAction($id)
    {
        $locations = $this->getDoctrine()->getManager()
            ->getRepository('MobileAPIBundle:Location')
            ->find($id);
        $serializer = new Serializer ([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($locations);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()  ;
        $location = new Location();
        $location->setTitre($request->get('titre'));
        $location->setLieu($request->get('lieu'));
        $location->setPrix($request->get('prix'));
        $location->setPhoto($request->get('photo'));
        $location->setRating($request->get('rating'));
        $location->setDateCreation($request->get('dateCreation'));
       
        $em->persist($location);
        $em->flush();
        $serializer = new serializer ([new objectNormalizer()]);
        $formatted = $serializer->normalize($location);
        return new JsonResponse($formatted);
    }


    public function updateAction (){
        $em = $this->getDoctrine()->getManager()  ;

      $em->persist($location);
        $em->flush();
        $serializer = new serializer ([new objectNormalizer()]);
        $formatted = $serializer->normalize($location);
        return new JsonResponse($formatted);
    }
}