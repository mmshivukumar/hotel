<?php

namespace  Room\SiteManagementBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use Trip\BookingEngineBundle\DTO\Catalogue;
/**
 * This is Catalogue Service.    
 *
 */
class CatalogueService
{
	private $container;
	private $em;
	private $session;
	private $logger;
	
	/**
	 * Constructor 
	 * @param EntityManager $entityManager
	 * @param ContainerInterface $container
	 * @param unknown $session
	 */
	public function __construct(EntityManager $entityManager,ContainerInterface $container,$session)
	{
		$this->session = $session;
		$this->container = $container;
        $this->em = $entityManager;
		$this->logger = $this->container->get('logger');
    }
    public function getCities(){
        $locations = $this->em->getRepository('RoomSiteManagementBundle:City')->findAll();
        return $locations;
    }
    public function getAmenities(){
    	$locations = $this->em->getRepository('RoomSiteManagementBundle:Amenities')->findAll();
    	return $locations;
    }
    public function getHotels(){
    	$locations = $this->em->getRepository('RoomHotelBundle:Hotel')->findAll();
    	return $locations;
    }
    public function getBookings(){
    	$locations = $this->em->getRepository('RoomBookingEngineBundle:Booking')->findAll();
    	return $locations;
    }
    public function getCustomers(){
    	$locations = $this->em->getRepository('RoomBookingEngineBundle:Customer')->findAll();
    	return $locations;
    }
    public function getHotelsByCity($city){
    	$locations = $this->em->getRepository('RoomHotelBundle:Hotel')->findByCityId($city);
    	return $locations;
    }
    public function getBookingsBySearch($bookingSearch){
    	$locations = $this->em->getRepository('RoomBookingEngineBundle:Booking')->findAll();
    	return $locations;
    }
    
    public function getAmenitiesById($amenitiesMstr){
    	$amenities = array();
    	foreach($amenitiesMstr as $a){
    		$amenities[$a->getId()] = $a;
    	}
    	return $amenities;
    }
    public function getById($collection){
    	$tempCollection = array();
    	foreach($collection as $a){
    		$tempCollection[$a->getId()] = $a;
    	}
    	return $tempCollection;
    }
    /**
     * 
     * @param unknown $hotels
     * @return multitype:
     */
    public function getFilters($hotels,$amenitiesMstr){
    	$filters = array();
    	$locations = array();
    	$price = array();
    	$amenities = array();
    	$categories = array();
    	$maxPrice = 0;
    	$minPrice = 100000;
    	$amenitiesMstr = $this->getAmenitiesById($amenitiesMstr);
    	foreach($hotels as $hotel){
    		$address = $hotel->getAddress();
    		$hotelAmenities = $hotel->getAmenities();
    		$category = $hotel->getCategory();
    		$location = $address->getLocation();
    		$price = $hotel->getPrice();
    		
    		if($price>$maxPrice)
    		$maxPrice = $price;
    		if($price<$minPrice)
    		$minPrice = $price;
    		
    		if(!is_null($category))
    			$categories[$category] = $category.' Star';
    		$locations[$location] = $location;
    		
    		foreach($hotelAmenities as $amenity){
    			$mstrAmenity = $amenitiesMstr[$amenity->getAmenity()];
    			$amenities[$mstrAmenity->getId()] = $mstrAmenity->getName();
    		}
    	}
    	
    	$filters['locations'] = $locations;
    	$filters['categories'] = $categories;
    	$filters['amenities'] = $amenities;
    	$filters['price']=array('maxPrice'=>$maxPrice,'minPrice'=>$minPrice);
    	return $filters;
    }	
    
    /**
     * 
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterHotels($search,$hotels,$minPrice,$maxPrice){
    	
    	$slectedLocations = $search->getLocation();
    	$slectedCategories = $search->getCategories();
    	
    	if(count($slectedLocations)>0)
    		$hotels = $this->filterByLocation($slectedLocations,$hotels);
    	
    	$hotels = $this->filterByPrice($search,$hotels,$minPrice,$maxPrice);
    	
    	if(count($slectedCategories)>0)
    		$hotels = $this->filterByCategory($slectedCategories,$hotels);
    	return $hotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByLocation($slectedLocations,$hotels){
    	$tempHotels = array();
    	foreach($hotels as $hotel){
    		$address = $hotel->getAddress();
    		$hotelAmenities = $hotel->getAmenities();
    		$category = $hotel->getCategory();
    		$location = $address->getLocation();
    		$price = $hotel->getPrice();
    		//echo $location;
    		
    		foreach($slectedLocations as $slectedLocation){
    		//	echo $slectedLocation;
    		if ($location==$slectedLocation)
    			$tempHotels[] = $hotel;
    		}
    	}
    	return $tempHotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByPrice($search,$hotels,$minPrice,$maxPrice){
    	$tempHotels = array();
    	foreach($hotels as $hotel){
    		$address = $hotel->getAddress();
    		$hotelAmenities = $hotel->getAmenities();
    		$category = $hotel->getCategory();
    		$location = $address->getLocation();
    		$price = $hotel->getPrice();
    		//echo $price;
    		//echo $minPrice;
    		//echo $maxPrice;
    		if ($price>=$minPrice && $price<=$maxPrice)
    			$tempHotels[] = $hotel;
    	}
    	//echo var_dump($tempHotels);
    	//exit();
    	return $tempHotels;
    }
    /**
     *
     * @param unknown $search
     * @param unknown $hotels
     * @return multitype:
     */
    public function filterByCategory($slectedCategories,$hotels){
    	$tempHotels = array();
    	foreach($hotels as $hotel){
    		$address = $hotel->getAddress();
    		$hotelAmenities = $hotel->getAmenities();
    		$category = $hotel->getCategory();
    		$location = $address->getLocation();
    		$price = $hotel->getPrice();	    		
    		//echo var_dump($slectedCategories);
    		foreach($slectedCategories as $selectedCategory){
    			//echo $category;
    			//echo $selectedCategory;
    			if ($category==$selectedCategory)
    				$tempHotels[] = $hotel;
    		}
    	}
    	//exit();
    	return $tempHotels;
    }
	
}
