<?php

namespace RentBundle\Controller;

use RentBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
    public function homeAction()
    {
        return $this->render('RentBundle:Default:index.html.twig');
    }


    public function indexAction()
    {
       // $user =$this->getUser();
    //if($user){
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('RentBundle:Location')->findAll();
    /*}else{
        $this->redirectToRoute('fos_user_security_login');
      }*/
        return $this->render('RentBundle:location:location.html.twig', array(
            'locations' => $locations,
        ));
        //var_dump($locations); die()
    }
    
    /**
     * Creates a new location entity.
     *
     */
    /*public function newAction(Request $request)
    {
        $location = new Location();
        $form = $this->createForm('RentBundle\Form\LocationType', $location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($location);
            $em->flush();

            return $this->redirectToRoute('location_show', array('id' => $location->getId()));
        }

        return $this->render('RentBundle:location:new.html.twig', array(
            'location' => $location,
            'form' => $form->createView(),
        ));
    }*/
    public function newAction(Request $request)
    {
            // $user =$this->getUser();
    //if($user){
      $em=$this->getDoctrine()->getEntityManager();
      $location = new Location();
/*}else{
        $this->redirectToRoute('fos_user_security_login');
      }*/
      $form=$this->createFormBuilder($location)
      ->add('titre',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('lieu',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('prix',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('photo',TextType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      //->add('rating',IntegerType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->add('Submit',SubmitType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
      ->getForm();

 $form->handleRequest($request);

 if ($form->isSubmitted() && $form->isValid() ) {
   $location->setTitre($form['titre']->getData());
   $location->setLieu($form['lieu']->getData());
   $location->setPrix($form['prix']->getData());
   $location->setPhoto($form['photo']->getData());
   //$location->setRating($form['rating']->getData() );
   
   $em->persist ($location);
   $em->flush();

   $this->addFlash('success','your rent has been successfuly persisted !');

   return $this->redirect ($this->generateUrl('location_confirmation'));
 }

return $this->render('RentBundle:location:new.html.twig', array (
  'form'=>$form->createView()
)) ; 
    }

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
    public function editAction(Request $request, Location $location)
    {
        $deleteForm = $this->createDeleteForm($location);
        $editForm = $this->createForm('RentBundle\Form\LocationType', $location);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_edit', array('id' => $location->getId()));
        }
 $em->persist ($location);
   $em->flush();

   $this->addFlash('success','your rent has been successfuly updated !');

        return $this->render('RentBundle:location:edit.html.twig', array(
            'location' => $location,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a location entity.
     *
     */
    public function deleteAction($id)
    {
      /*  $form = $this->createDeleteForm($location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($location);
            $em->flush();
        }
        return $this->redirectToRoute('location_homepage');*/

        $em=$this->getDoctrine()->getEntityManager();
        $location = $em->getRepository('RentBundle:Location')->find($id);
       
        $em->remove($location);
        $em->flush();
        return $this->redirect ($this->generateUrl('location_homepage'));
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

   /* public function rechercheAction(Request $request)
    {
         $em=$this->getDoctrine()->getManager();
         $find=$em->getRepository(Location::class)->findAll();
         if ($request->isMethod('POST')){
             $type=$request->get('titre');
             $find=$em->getRepository(Location::class)->findBy(array('titre'=>$titre));
         }
        return $this->render("RentBundle:location:show.html.twig", array(
            "titre" => $titre
        ));
    }
    
      public function searchbynameAction($name){
        $club = $this->getDoctrine()->getRepository(Club::class);
        $re =$club->myfindName($name);
        dump($re);
        die();
        return $this->render('@Club/Club/search.html.twig',
            ['club'=>$re]);

    }
    public function getelementAction($id){
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
 
}
