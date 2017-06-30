<?php

namespace Room\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Room\HotelBundle\Form\HotelDetailType;
use Room\HotelBundle\Entity\Hotel;
use Room\HotelBundle\Entity\HotelAddress;
use Room\HotelBundle\DTO\HotelDto;

class HotelController extends Controller
{
    public function addHotelAction(Request $request)
    {
    	$security = $this->container->get ( 'security.context' );
    	 
    	$user = $security->getToken ()->getUser ();
    	 
    	if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
    		 
    		return $this->redirect ( $this->generateUrl ('room_security_user_login') );
    		 
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	$hotelDetail = new HotelDto();
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$form = $this->createForm(new HotelDetailType($catalogueService),$hotelDetail);
    	$form->add('submit','submit', array('label' => 'Add'));
    	$form ->handleRequest($request);
    		
    	if($form->isValid()) {
    	
    					$hotelObj = new Hotel();
	
			$hotelAddressObj = new HotelAddress();
			
			$catalogueService = $this->container->get( 'catalogue.service' );
			$cities = $catalogueService->getCities();
			$cities = $catalogueService->getById($cities);
			
			$selectedCity = $cities[$hotelDetail->getCity()];
	
			$hotelObj->setName($hotelDetail->getName());
			$hotelObj->setOverview($hotelDetail->getOverview());
			$hotelObj->setPropertyType($hotelDetail->getPropertyType());
			$hotelObj->setCategory($hotelDetail->getCategory());
			$hotelObj->setCheckIn($hotelDetail->getCheckIn());
			$hotelObj->setCheckOut($hotelDetail->getCheckOut());
			$hotelObj->setPrice($hotelDetail->getPrice());
			$hotelObj->setCity($selectedCity->getName());
			$hotelObj->setNumRooms($hotelDetail->getNumRooms());
			$hotelObj->setSoldOut($hotelDetail->getSoldOut());
			$hotelObj->setPriority($hotelDetail->getPriority());
			$hotelObj->setCityId($selectedCity->getId());
			$hotelObj->setActive($hotelDetail->getActive());
	
			$hotelAddressObj->setAddressLine1($hotelDetail->getAddressLine1());
			$hotelAddressObj->setAddressLine2($hotelDetail->getAddressLine2());
			$hotelAddressObj->setLocation($hotelDetail->getLocation());
			$hotelAddressObj->setPincode($hotelDetail->getPincode());
			$hotelAddressObj->setCity($selectedCity->getName());
			$hotelAddressObj->setCityId($selectedCity->getId());
	
	
			$hotelObj->setAddress($hotelAddressObj);
			$hotelAddressObj->setHotel($hotelObj);
			//$hotelObj->setImages($hotelDetail->getImages());
			//$hotelObj->setAmenities($hotelDetail->getAmenities());
	
			$em->persist($hotelObj);
			
    		$em->flush();
/*     		
    		$this->addFlash(
    				'Notice',
    				'Hotel Detail Added'
    		); */
    		
    		return $this->redirect ( $this->generateUrl ( "room_hotel_add_hotel" ) );
    	}
    	
    	return $this->render('RoomHotelBundle:Default:add-hotel.html.twig',array(

	 		'form' => $form->createView(),
	 ));
    
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	public function searchHotelAction(Request $request)
	{
		$security = $this->container->get ( 'security.context' );
		 
		$user = $security->getToken ()->getUser ();
		 
		if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
			 
			return $this->redirect ( $this->generateUrl ('room_security_user_login') );
			 
		}
		$em = $this->getDoctrine()->getManager();
		$hotels = $em->getRepository('RoomHotelBundle:Hotel')->findAll();
		return $this->render('RoomHotelBundle:Default:hotel-search.html.twig', array(
				//'form'   => $form->createView(),
				'hotels'=> $hotels
		));
	}
	
	public function editHotelAction(Request $request,$id)
	{
		$security = $this->container->get ( 'security.context' );
		 
		$user = $security->getToken ()->getUser ();
		 
		if (! $security->isGranted ( 'ROLE_SUPER_ADMIN' )) {
			 
			return $this->redirect ( $this->generateUrl ('room_security_user_login') );
			 
		}
		$em = $this->getDoctrine()->getManager();
		$hotelObj = $em->getRepository('RoomHotelBundle:Hotel')->find($id);
		$hotelDetail = new HotelDto();
		
		$catalogueService = $this->container->get( 'catalogue.service' );
		
		
		$hotelDetail->setName($hotelObj->getName());
		$hotelDetail->setOverview($hotelObj->getOverview());
		$hotelDetail->setPropertyType($hotelObj->getPropertyType());
		$hotelDetail->setCategory($hotelObj->getCategory());
		$hotelDetail->setCheckIn($hotelObj->getCheckIn());
		$hotelDetail->setCheckOut($hotelObj->getCheckOut());
		$hotelDetail->setPrice($hotelObj->getPrice());
		$hotelDetail->setCity($hotelObj->getCityId());
		$hotelDetail->setNumRooms($hotelObj->getNumRooms());
		$hotelDetail->setSoldOut($hotelObj->getSoldOut());
		$hotelDetail->setPriority($hotelObj->getPriority());
		//$HotelObj->setCityId($hotelObj->getCityId());
		$hotelDetail->setActive($hotelObj->getActive());
		
		$hotelAddressObj = $hotelObj->getAddress();
		
		$hotelDetail->setAddressLine1($hotelAddressObj->getAddressLine1());
		$hotelDetail->setAddressLine2($hotelAddressObj->getAddressLine2());
		$hotelDetail->setLocation($hotelAddressObj->getLocation());
		$hotelDetail->setPincode($hotelAddressObj->getPincode());
		
		 
		$form = $this->createForm(new HotelDetailType($catalogueService),$hotelDetail);
		$form->add('submit','submit', array('label' => 'Add'));
		$form ->handleRequest($request);
		 
		if($form->isValid()) {
			 
			
			$cities = $catalogueService->getCities();
			$cities = $catalogueService->getById($cities);
				
			$selectedCity = $cities[$hotelDetail->getCity()];
	
			$hotelObj->setName($hotelDetail->getName());
			$hotelObj->setOverview($hotelDetail->getOverview());
			$hotelObj->setPropertyType($hotelDetail->getPropertyType());
			$hotelObj->setCategory($hotelDetail->getCategory());
			$hotelObj->setCheckIn($hotelDetail->getCheckIn());
			$hotelObj->setCheckOut($hotelDetail->getCheckOut());
			$hotelObj->setPrice($hotelDetail->getPrice());
			$hotelObj->setCity($selectedCity->getName());
			$hotelObj->setNumRooms($hotelDetail->getNumRooms());
			$hotelObj->setSoldOut($hotelDetail->getSoldOut());
			$hotelObj->setPriority($hotelDetail->getPriority());
			$hotelObj->setCityId($selectedCity->getId());
			$hotelObj->setActive($hotelDetail->getActive());
	
			$hotelAddressObj->setAddressLine1($hotelDetail->getAddressLine1());
			$hotelAddressObj->setAddressLine2($hotelDetail->getAddressLine2());
			$hotelAddressObj->setLocation($hotelDetail->getLocation());
			$hotelAddressObj->setPincode($hotelDetail->getPincode());
				$hotelAddressObj->setCity($selectedCity->getName());
			$hotelAddressObj->setCityId($selectedCity->getId());
	
	
			$hotelObj->setAddress($hotelAddressObj);
			$hotelAddressObj->setHotel($hotelObj);
			//$hotelObj->setImages($hotelDetail->getImages());
			//$hotelObj->setAmenities($hotelDetail->getAmenities());
	
			$em->merge($hotelObj);
	
			$em->flush();
			/*
			 $this->addFlash(
			 		'Notice',
			 		'Hotel Detail Added'
			 ); */
	
			return $this->redirect ( $this->generateUrl ( "room_hotel_add_hotel" ) );
		}
		 
		return $this->render('RoomHotelBundle:Default:add-hotel.html.twig',array(
	
				'form' => $form->createView(),
		));
	
	}


}
