<?php

namespace Room\SiteManagementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Room\SiteManagementBundle\Form\ContactType;
use Room\SiteManagementBundle\Entity\Contact;
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
    			'method' => 'GET',
    	));
    		
    	return $form;
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