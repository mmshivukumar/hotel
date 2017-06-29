<?php

namespace Room\SiteManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Room\SiteManagementBundle\Form\ContactType;
use Room\SiteManagementBundle\Entity\Contact;
use Room\SiteManagementBundle\Form\BookingSearchType;
use Room\SiteManagementBundle\DTO\BookingSearch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteManagementController extends Controller
{
    /**
     * 
     */
    public function aboutAction()
    {
    	return $this->render('RoomSiteManagementBundle:Default:about-us.html.twig');
    }
    
    
    
    
    /**
     *
     * @param Contact $entity
     * @return unknown
     */
    private function createContactForm(Contact $dto){
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$form = $this->createForm(new ContactType($catalogueService), $dto, array(
    			'action' => $this->generateUrl('room_site_management_contact_us'),
    			'method' => 'POST',
    	));
    		
    	return $form;
    }
    
    /**
     *
     * @param Contact $entity
     * @return unknown
     */
    private function createBookingSearchForm(BookingSearch $dto){
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$form = $this->createForm(new BookingSearchType($catalogueService), $dto, array(
    			'action' => $this->generateUrl('room_site_management_booking_search'),
    			'method' => 'GET',
    	));
    	
    	$form->add ( 'submit', 'submit', array (
    			'label' => 'Search'
    	) );
    
    	return $form;
    }
    
    
    /**
     *
     * @param Request $request
     */
    public function bookingSearchAction(Request $request)
    {
    	$security = $this->container->get ( 'security.context' );
    	
    	$user = $security->getToken ()->getUser ();
    	
    	if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
    	
    		return $this->redirect ( $this->generateUrl ('room_security_user_login') );
    	
    	}
    	$bookings = array();
    	$bookingSearch = new BookingSearch();
    	$form   = $this->createBookingSearchForm($bookingSearch);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		
    		$catalogueService = $this->container->get( 'catalogue.service' ); 
    		$bookings = $catalogueService->getBookingsBySearch($bookingSearch);
    		$customers = $catalogueService->getCustomers();
    		$customers = $catalogueService->getById($customers);
    		//$hotels = $catalogueService->getHotels();
    		//$hotels = $catalogueService->getById($hotels);
    		
    		return $this->render('RoomSiteManagementBundle:Default:booking-search.html.twig', array(
    				'form'   => $form->createView(),
    				'bookings'=>$bookings,
    				'customers'=>$customers,
    				//'hotels'=>$hotels
    		));
    	}
    	return $this->render('RoomSiteManagementBundle:Default:booking-search.html.twig', array(
    			'form'   => $form->createView(),
    			'bookings'=>$bookings
    	));
    }
    /**
     * 
     * @param Request $request
     */
    public function contactAction(Request $request)
    {
    	$contact = new Contact();
    	$form   = $this->createContactForm($contact);
    	$form->handleRequest($request);
    	if ($form->isValid()) {    	
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($contact);
    		$em->flush();
    		
    		return $this->render('RoomSiteManagementBundle:Default:contact-us.html.twig', array(
    				'form'   => $form->createView(),
    		));
    	}
    	return $this->render('RoomSiteManagementBundle:Default:contact-us.html.twig', array(
    			'form'   => $form->createView(),
    	));
    }
}