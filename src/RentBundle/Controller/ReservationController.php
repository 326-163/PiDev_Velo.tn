<?php

namespace RentBundle\Controller;

use RentBundle\Entity\Reservation;
use RentBundle\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
/**
 * Reservation controller.
 *
 */
class ReservationController extends Controller
{
    /**
     * Lists all reservation entities.
     *
     */
    public function indexAction()
    {
        // $user =$this->getUser();
    //if($user){
        $em = $this->getDoctrine()->getManager();
        $reservations = $em->getRepository('RentBundle:Reservation')->findAll();  
    /*}else{
        $this->redirectToRoute('fos_user_security_login');
      }*/
        return $this->render('reservation/index.html.twig', array(
            'reservations' => $reservations,
        ));
          var_dump($locations); die();
    }
      
    /**
     * Creates a new reservation entity.
     *
     */
    public function newAction(Request $request)
    {
         // $user =$this->getUser();
        //if($user){
        $em=$this->getDoctrine()->getEntityManager();
        $reservation = new Reservation();
        /*}else{
          $this->redirectToRoute('fos_user_security_login');
        }*/
        $form=$this->createFormBuilder($reservation)
        ->add('dateDeb',DateTimeType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
        ->add('dateFin',DateTimeType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
        ->add('Enregistrer',SubmitType::class,array('attr'=>array('class'=>'col-md-4 form-control')))
        ->getForm();
  
   $form->handleRequest($request);
  
   if ($form->isSubmitted() && $form->isValid() ) {
     $reservation->setDateDeb($form['dateDeb']->getData());
     $reservation->setDateFin($form['dateFin']->getData());
      
     $em->persist ($reservation);
     $em->flush();
  
     $this->addFlash('success','reservation ajoutée avec succees  !');
  
     return $this->redirect ($this->generateUrl('reservation_show'));
   }
  
  return $this->render('RentBundle:reservation:new.html.twig', array (
    'form'=>$form->createView()
  )) ; 
    }
   
    
    /**
     * Finds and displays a reservation entity.
     *
     */
    public function showAction( $id)
    {
      $em = $this->getDoctrine()->getEntityManager();
      $reservation = $em->getRepository('RentBundle:Reservation')->find($id);
      $locations = $em->getRepository('RentBundle:Location')->findAll();
      return $this->render('RentBundle:reservation:show.html.twig',array(
        'reservation' => $reservation,
        'locations' => $locations,
      ));
    }
    /**
     * Displays a form to edit an existing reservation entity.
     *
     */
    public function editAction(Request $request, Reservation $reservation)
    {
       $deleteForm = $this->createDeleteForm($reservation);
        $editForm = $this->createForm('RentBundle\Form\ReservationType', $reservation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('reservation_edit', array('id' => $reservation->getId()));
        }

        return $this->render('reservation/edit.html.twig', array(
            'reservation' => $reservation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservation entity.
     *
     */
    public function deleteAction(Request $request, Reservation $reservation)
    {
        $form = $this->createDeleteForm($reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservation);
            $em->flush();
        }

        return $this->redirectToRoute('reservation_index');
    }

    /**
     * Creates a form to delete a reservation entity.
     *
     * @param Reservation $reservation The reservation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reservation $reservation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservation_delete', array('id' => $reservation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function  notifAction(Request $request, Reservation $reservation)
    {

    }
   
}
