<?php

namespace RentBundle\Controller;

use RentBundle\Entity\Location;
use RentBundle\Form\LocationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Location controller.
 *
 */
class LocationController extends Controller
{
    /**
     * Home.
     *
     */
    public function indexAction()
    {
        //$user =$this->getUser();
        //if($user){
        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('RentBundle:Location')->findAll();
        //}else{
        //  $this->redirectToRoute('fos_user_security_login');
        //}
        return $this->render('RentBundle:location:location.html.twig', array(
            'locations' => $locations,
        ));
        var_dump($locations);
        die();
    }

    /**
     * Creates a new location entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $location = new Location();
        $form = $this->createForm('RentBundle\Form\LocationType', $location);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file=$location->getPhoto();
            $filename= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('photos_directory'),$filename);
            $location->setPhoto($filename);

            $location->setdateCreation(new \DateTime('now'));
            $em->persist($location);
            $em->flush();

            $this->addFlash('success','publication ajoutee !');

            return $this->redirectToRoute('location_homepage');
        }
        return $this->render('RentBundle:location:new.html.twig', array(
//          'location' => $location,
            'form' => $form->createView(),
        ));
    }



    /*public function newAction(Request $request)
    {
      $user =$this->getUser();
       if($user){

      $em=$this->getDoctrine()->getEntityManager();
      $location = new Location();
       }else{
        $this->redirectToRoute('fos_user_security_login');
      }
      $form=$this->createFormBuilder($location)
      ->add('titre',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('lieu',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('prix',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('photo',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      //->add('rating',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('dateCreation',DateTimeType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('Submit',SubmitType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->getForm();
 $form->handleRequest($request);
 if ($form->isSubmitted() && $form->isValid() ) {
   $location->setTitre($form['titre']->getData());
   $location->setLieu($form['lieu']->getData());
   $location->setPrix($form['prix']->getData());
   $location->setPhoto($form['photo']->getData());
   //$location->setRating($form['rating']->getData());
   $location->setDateCreation($form['dateCreation']->getData());
   $em->persist ($location);
   $em->flush();
   $this->addFlash('success','your rent has been successfuly persisted !');
   return $this->redirect ($this->generateUrl('location_confirmation'));
 }
return $this->render('RentBundle:location:new.html.twig', array (
  'form'=>$form->createView()
)) ;
    }*/

    /**
     * Finds and displays a location entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $location = $em->getRepository('RentBundle:Location')->find($id);
        $locations = $em->getRepository('RentBundle:Location')->findAll();
        return $this->render('RentBundle:location:show.html.twig', array(
            'location' => $location,
        ));
    }

    /**
     * Displays a form to edit an existing location entity.
     *
     */
    public function editAction(Request $request, $id)
    {
        /* $location = $this->getDoctrine()->getRepository(Location::class)->find($id);
         $form = $this->createForm('RentBundle\Form\LocationType', $location);
         $form->handleRequest($request);
         if ($form->isSubmitted()) {
             $em = $this->getDoctrine()->getManager();
             $em->persist($location);
             $em->flush();
             $this->addFlash('success','your rent has been successfuly updated !');
             return $this->redirect ($this->generateUrl('location_show'));
         }*/


        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $em=$this->getDoctrine()->getEntityManager();
        $location = $em->getRepository('RentBundle:Location')->find($id);

        $form=$this->createFormBuilder($location)
            ->add('titre',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->add('lieu',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->add('prix',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->add('photo',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            //->add('rating',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->add('dateCreation',DateTimeType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->add('Enregistrer',SubmitType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted () ) {
            $location->setTitre($form['titre']->getData());
            $location->setLieu($form['lieu']->getData());
            $location->setPrix($form['prix']->getData());
            $location->setPhoto($form['photo']->getData());
            //$location->setRating($form['rating']->getData() );
            $location->setDateCreation($form['dateCreation']->getData());
            $em->persist ($location);
            $em->flush();

            $this->addFlash('success','your rent has been successfuly persisted !');

            return $this->redirect ($this->generateUrl('location_confirmation'));
        }

        return $this->render('RentBundle:location:edit.html.twig', array (
            'form'=>$form->createView()
        )) ;
    }


    /**
     * Deletes a location entity.
     *
     */
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $location = $em->getRepository('RentBundle:Location')->find($id);

        $em->remove($location);
        $em->flush();
        return $this->redirectToRoute('location_homepage');
    }


    /**
     * Creates a form to delete a location entity.
     *
     * @param Location $location The location entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Location $location)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('location_delete', array('id' => $location->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    /**
     * confirmation.
     *
     */
    public function confirmeAction()
    {
        return $this->render('RentBundle:location:confirmation.html.twig');
    }

  

    public function searchbytitleAction(Request $request)
     {
          $em=$this->getDoctrine()->getManager();
          $location = $em->getRepository(Location::class)->findAll();
          if ($request->isMethod('POST')){
              $titre=$request->get('titre');
              $location=$em->getRepository("RentBundle:Location")->findBy(array('titre'=>$titre));
          }
         return $this->render("RentBundle:location:search.html.twig",
             array("location" => $location ) );
     }


     /*public function getelementAction($id){
         $club = $this->getDoctrine()->getRepository(Club::class);
         $re =$club->findonebyname($id);
         //dump($re);
         return $this->render('@Club/Club/search.html.twig',
             ['club'=>$re]);
     }

     public function SendEmailAction(){
         $message = \Swift_Message::newInstance()
         ->setSubject('Formalab')
         ->setFrom('nahawand.laajili@gmail.com')
         ->setTo('nahawand.laajili@gmail.com')
         ->setBody('test from nahawand');
         $this->get('mailer')
             ->send($message);
         return $this->render('send.html.twig');
      }


      public function countaction ()
      {
        // yay! Use this to see if the user is logged in
  if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
    throw $this->createAccessDeniedException();
  }
  }
     */
    public function highdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('RentBundle:Location')->findBy([], ['dateCreation' => 'DESC']);
        return $this->render( 'RentBundle:location:location.html.twig', array('locations'=> $rep));
    }

    public function lowdateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('RentBundle:Location')->findBy([], ['dateCreation' => 'ASC']);
        return $this->render( 'RentBundle:location:location.html.twig', array('locations'=> $rep));
    }

    public function highprixAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('RentBundle:Location')->findBy([], ['prix' => 'DESC']);
        return $this->render( 'RentBundle:location:location.html.twig', array('locations'=> $rep));
    }

    public function lowprixAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('RentBundle:Location')->findBy([], ['prix' => 'ASC']);
        return $this->render('RentBundle:location:location.html.twig', array(
            'locations' => $rep,
        ));
        var_dump($locations);
        die();
     }

}
