<?php


namespace Mobile\MobileAPIBundle\Controller;

use Mobile\MobileAPIBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LocationController extends Controller
{

    public function allAction ()
    {
        $em = $this->getDoctrine()->getManager();
        $reservations =$em->getRepository('MobileAPIBundle:Location')->findAll();

       $normalizer = new ObjectNormalizer();
         $normalizer->setCircularReferenceLimit(2);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers);
        $reservationss=array();
        foreach ($reservations as $reservation) {

            $r=array("id"=>$reservation->getId(),
                    "titre"=>$reservation->getTitre(),
                    "lieu"=>$reservation->getLieu(),
                    "photo"=>$reservation->getPhoto(),
                    "rating"=>$reservation->getRating(),
                    "dateCreation"=>$reservation->getDateCreation()

                );
                   
                   
            array_push($reservationss,$r);

        }
        $formatted=$serializer->normalize($reservationss);
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
       // $location->setRating($request->get('rating'));
        $location->setDateCreation($request->get('dateCreation'));
       
        $em->persist($location);
        $em->flush();
        $serializer = new serializer ([new objectNormalizer()]);
        $formatted = $serializer->normalize($location);
        return new JsonResponse($formatted);
    }


    public function updateAction (Request $request, $id){
        $em = $this->getDoctrine()->getManager()  ;

      $em->persist($location);
        $em->flush();
        $serializer = new serializer ([new objectNormalizer()]);
        $formatted = $serializer->normalize($location);
        return new JsonResponse($formatted);
    }

    public function deleteAction(Request $request)
    {
        $token = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $location = $this->getDoctrine()->getRepository(Location::class)->find($token);

        $em->remove($location);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($location);
        return new JsonResponse($formatted);
    }

}