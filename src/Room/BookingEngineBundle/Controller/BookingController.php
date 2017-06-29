<?php

namespace Room\BookingEngineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Room\BookingEngineBundle\Form\SearchType;
use Room\BookingEngineBundle\Form\FilterType;
use Room\BookingEngineBundle\Form\CustomerType;
use Room\BookingEngineBundle\DTO\Search;
use Room\BookingEngineBundle\Entity\Customer;
use Room\BookingEngineBundle\Entity\Booking;

class BookingController extends Controller
{ 

	/**
	 *
	 * @param Search $entity
	 * @return unknown
	 */
	private function createSearchForm(Search $dto){
		$catalogueService = $this->container->get( 'catalogue.service' );
		$form = $this->createForm(new SearchType($catalogueService), $dto, array(
				'action' => $this->generateUrl('room_booking_engine_search'),
				'method' => 'GET',
		));
		 
		return $form;
	}
	/**
	 *
	 * @param Search $entity
	 * @return unknown
	 */
	private function createFilterForm(Search $dto,$filters){
		$form = $this->createForm(new FilterType($filters), $dto, array(
				'action' => $this->generateUrl('room_booking_engine_filter'),
				'method' => 'GET',
		));
			
		return $form;
	}
	/**
	 * 
	 */
	public function indexAction()
	{
		$search = new Search();
		$search->setNumAdult(2);
		$search->setNumRooms(1);
		$form   = $this->createSearchForm($search);
		return $this->render('RoomBookingEngineBundle:Default:index.html.twig', array(
                'form'   => $form->createView(),
				'search'=>$search               
            ));
	}
	/**
	 * 
	 */
	public function addRoomAction(Request $request){
		
		$room = new Room;
		return $this->render('RoomBookingEngineBundle:Default:index.html.twig', array(
				'form'   => $form->createView(),
				'search'=>$search
		));
	}
	/**
	 * 
	 * @param Request $request
	 */
    public function searchAction(Request $request)
    {
    	$hotels = array();
    	$search = new Search();    	
    	$form   = $this->createSearchForm($search);
    	$form->handleRequest($request);
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$hotels = $catalogueService->getHotelsByCity($search->getCity());
    	$amenities = $catalogueService->getAmenities();
    	$filters = $catalogueService->getFilters($hotels,$amenities);
    	$search->setMinPrice($filters['price']['minPrice']);
    	$search->setMaxPrice($filters['price']['maxPrice']);
    	$search->setMin($filters['price']['minPrice']);
    	$search->setMax($filters['price']['maxPrice']);
    	$session = $request->getSession();
    	$session->set('search',$search);
    	$session->set('hotels',$hotels);
    	$session->set('filters',$filters);
    	
    	$filterForm   = $this->createFilterForm($search,$filters);
    		   		
    	return $this->render('RoomBookingEngineBundle:Default:search.html.twig', array(
                'form'   => $form->createView(),     
    			'filterForm'   => $filterForm->createView(),
    			'hotels'=>$hotels,
    			'search'=>$search
         ));
            
    }
    /**
     *
     * @param Request $request
     */
    public function filterAction(Request $request)
    {
    	$session = $request->getSession();
    	$hotels = array();
    	$search = $session->get('search');
    	$form   = $this->createSearchForm($search);
    	
    	$hotels = $session->get('hotels');
    	$filters = $session->get('filters');

    	$filterForm   = $this->createFilterForm($search,$filters);   	
    	$filterForm->handleRequest($request);
    	
    	$price = $search->getPrice();
    	$minMaxPrice = explode ( ";", $price );
    	$minPrice = ( float ) $minMaxPrice [0];
    	$maxPrice = ( float ) $minMaxPrice [1];
    	$search->setMinPrice($minPrice);
    	$search->setMaxPrice($maxPrice);
    	
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$hotels = $catalogueService->filterHotels($search,$hotels,$minPrice,$maxPrice);
    		
    	return $this->render('RoomBookingEngineBundle:Default:search.html.twig', array(
    			'form'   => $form->createView(),
    			'filterForm'   => $filterForm->createView(),
    			'hotels'=>$hotels,
    			'search'=>$search,
    	));
    
    }
    /**
     * 
     * @param Request $request
     * @param unknown $id
     */
    public function viewMoreAction(Request $request,$id)
    {
    	$search = new Search();
    	$form   = $this->createSearchForm($search);
    	$em = $this->getDoctrine()->getManager();
    	$hotel = $em->getRepository('RoomHotelBundle:Hotel')->find($id);
    	return $this->render('RoomBookingEngineBundle:Default:view-more.html.twig', array(
    			'form'   => $form->createView(),
    			'hotel'=> $hotel
    	));
    }
    
    /**
     * 
     * @param Customer $dto
     * @return unknown
     */
    private function createBookingForm(Customer $dto){
    	$catalogueService = $this->container->get( 'catalogue.service' );
    	$form = $this->createForm(new CustomerType($catalogueService), $dto, array(
    			'action' => $this->generateUrl('room_booking_engine_booking_submit'),
    			'method' => 'POST',
    	));
    		
    	return $form;
    }
    
    /**
     *
     * @param Request $request
     */
    public function ConfirmAction(Request $request)
    {
    	 
    	$id = $request->get('id');
    	$session = $request->getSession();
    	$search = $session->get('search');
    	$customer = new Customer();
    	$form   = $this->createBookingForm($customer);
    	$em = $this->getDoctrine()->getManager();
    	$hotel = $em->getRepository('RoomHotelBundle:Hotel')->find($id);
    	$booking = new Booking();
    	$price = $hotel->getPrice();
    	$tax = $price*0.14;
    	$booking->setTotalPrice($price);
    	$booking->setServiceTax($tax);
    	$booking->setFinalPrice($tax+$price+150);
    	return $this->render('RoomBookingEngineBundle:Default:confirm.html.twig', array(
    			'form'   => $form->createView(),
    			'customer'=> $customer,
    			'hotel'=> $hotel,
    			'booking'=> $booking,
    			'search'=>$search,
    			'step'=> 'review'
    	));
    }
    /**
     * 
     * @param Request $request
     */
    public function bookingAction(Request $request)
    {
    	
    	$id = $request->get('id');
    	$session = $request->getSession();
    	$search = $session->get('search');
    	$customer = new Customer();
    	$form   = $this->createBookingForm($customer);
    	$em = $this->getDoctrine()->getManager();
    	$hotel = $em->getRepository('RoomHotelBundle:Hotel')->find($id);
    	$session->set('selected',$hotel);
    	$booking = new Booking();
    	$price = $hotel->getPrice();
    	$tax = $price*0.14;
    	$booking->setTotalPrice($price);
    	$booking->setServiceTax($tax);
    	$booking->setFinalPrice($tax+$price+150);
    	return $this->render('RoomBookingEngineBundle:Default:booking.html.twig', array(
    			'form'   => $form->createView(),
    			'customer'=> $customer,
    			'hotel'=> $hotel,
    			'booking'=> $booking,
    			'search'=>$search,
    			'step'=> 'review'
    	));
    }
    public function bookingSubmitAction(Request $request)
    {
    
    	//return $this->redirect ( $this->generateUrl ( "room_booking_engine_success" ) );
    	$session = $request->getSession();
    	$resultSet = $session->get('resultSet');
    	$searchFilter = $session->get('search');
    	$selectedService = $session->get('selected');
    
    
    	$customer = new Customer();
    	$form   = $this->createBookingForm($customer);
    	$form->handleRequest($request);
    	if ($form->isValid()) {
    		//$couponCode = $customer->getCouponCode();
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($customer);
    		$em->flush();
    		$session->set('customer',$customer);

    		$price = $selectedService->getPrice();
    		$finalPrice = $price;
    		
    		$booking = new Booking();
    		$booking->setCustomerId($customer->getId());
    		$booking->setBookingId($this->getBookingId());
    		$booking->setTotalPrice($price);
    		$booking->setFinalPrice($finalPrice);
    		$booking->setStatus('booked');
    		$booking->setJobStatus('Open');
    		$booking->setBookedOn(new \DateTime());
    		//$booking->setNumDays($searchFilter->getNumDays());
    		$booking->setNumAdult($searchFilter->getNumAdult());
    		$booking->setChekIn($searchFilter->getCheckIn());
    		$booking->setChekOut($searchFilter->getCheckOut());
    		
    		
    		$address = $selectedService->getAddress();
    		$booking->setHotelId($selectedService->getId());
    		$booking->setHotelName($selectedService->getName());
    		$booking->setLocation($address->getLocation());
    		$booking->setNumRooms(0);

    		$amountToPay = $finalPrice;
    		$tax = 0;
    		
    		$serviceTax = round($finalPrice*(5.6/100),2);
    		$swachBharthCess = round($finalPrice*(0.2/100),2);
    		$krishiKalyanCess = round($finalPrice*(0.2/100),2);
    		$totalTax = $serviceTax+$swachBharthCess+$krishiKalyanCess;
    		$amountToPay = $amountToPay+$totalTax;
    		$finalPrice = $finalPrice+$totalTax;
    		//$booking->setTax($tax);
    		$booking->setServiceTax($serviceTax);
    		$booking->setSwachBharthCess($swachBharthCess);
    		$booking->setKrishiKalyanCess($krishiKalyanCess);
    		$booking->setFinalPrice($finalPrice);
    		$booking->setCouponApplyed(0);
    		$em->persist($booking);
    		$em->flush();
    		$session->set('bookingObj',$booking);
    		$session->set('amountToPay',$amountToPay);
    		$paymentLink = $this->getPaymentLink($amountToPay);
    		//$paymentLink = "https://www.instamojo.com/Waseemsyed/tirupati-caars-services-cb8a4/";
    		$paymentLink.="?data_name=".$customer->getName()."&data_email=".$customer->getEmail()."&data_phone=".$customer->getMobile()."&embed=form";
    		
    		return $this->redirect ( $this->generateUrl ( "room_booking_engine_success" ) );
    		
    		return $this->render('RoomBookingEngineBundle:Default:payment.html.twig', array(
    				'customer'   => $customer,
    				'booking'   => $booking,
    				'service'=>$selectedService,
    				'filter'=>$searchFilter,
    				'paymentLink'   => $paymentLink,
    		));
    	}

    	return $this->render('RoomBookingEngineBundle:Default:booking.html.twig', array(
    			'form'   => $form->createView(),
    			'customer'=> $customer
    	));
    
    }
    
    public function getPaymentLink($amountToPay){
    	return '';
    }
    /**
     *
     */
    public function successAction()
    {

    	return $this->render('RoomBookingEngineBundle:Default:success.html.twig');
    }
    private function getBookingId(){
    	$characters = 'A5B0CD9EFG1HIJ3KLM46NOPQR7STUV8WXYZ';
    	$bookingId = 'SH';
    	date_default_timezone_set('Asia/Kolkata');
    	$current=date('d/m/Y');
    	list ( $d, $m, $y ) = explode ( '/', $current );
    	$bookingId.=$d.$m.substr($y,2);
    	for ($i = 0; $i < 4; $i++) {
    		$bookingId .= $characters[rand(0,strlen($characters)-1)];
    	}
    	return $bookingId;
    }
    
}
