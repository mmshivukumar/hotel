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
    public function hotelAddAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager();
    	$hotelDetail = new HotelDto();
    	
    	$form = $this->createForm(new HotelDetailType(),$hotelDetail);
    	$form->add('submit','submit', array('label' => 'Add'));
    	$form ->handleRequest($request);
    	
    	if($form->isValid()) {
    	
    		$HotelObj = new Hotel();
    		
    		$HotelAddressObj = new HotelAddress();
    		
    		$HotelObj->setName($hotelDetail->getName());
    		$HotelObj->setOverview($hotelDetail->getOverview());
    		$HotelObj->setPropertyType($hotelDetail->getPropertyType());
    		$HotelObj->setCategory($hotelDetail->getCategory());
    		$HotelObj->setCheckIn($hotelDetail->getCheckIn());
    		$HotelObj->setCheckOut($hotelDetail->getCheckOut());
    		$HotelObj->setPrice($hotelDetail->getPrice());
    		$HotelObj->setCity($hotelDetail->getCity());
    		$HotelObj->setNumRooms($hotelDetail->getNumRooms());
    		$HotelObj->setSoldOut($hotelDetail->getSoldOut());
    		$HotelObj->setPriority($hotelDetail->getPriority());
    		//$HotelObj->setCityId($hotelDetail->getCityId());
    		$HotelObj->setActive($hotelDetail->getActive());
    		
    		$HotelAddressObj->setAddressLine1($hotelDetail->getAddressLine1());
    		$HotelAddressObj->setAddressLine2($hotelDetail->getAddressLine2());
    		$HotelAddressObj->setLocation($hotelDetail->getLocation());
    		$HotelAddressObj->setPincode($hotelDetail->getPincode());
    		$HotelAddressObj->setCity($hotelDetail->getCity());
    		
    		
    		$HotelObj->setAddress($HotelAddressObj);
    		$HotelAddressObj->setHotel($HotelObj);
    		//$HotelObj->setImages($hotelDetail->getImages());
    		//$HotelObj->setAmenities($hotelDetail->getAmenities());
    		
    		$em->persist($HotelObj);
    		
    		$em->flush();
    		$this->addFlash(
    				'Notice',
    				'Hotel Detail Added'
    		);
    		
    		Return $this->redirectToRoute('RoomHotelBundle:Default:index.html.twig');
    	}
    	
    	return $this->render('RoomHotelBundle:Default:index.html.twig',array(

	 		'form' => $form->createView(),
	 ));
    
}

}
