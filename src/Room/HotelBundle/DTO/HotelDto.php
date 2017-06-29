<?php

namespace Room\HotelBundle\DTO;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Hotel
 *
 *
 * 
 */
class HotelDto
{
    /**
     * @var integer
     *
     */
    private $id;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     *
     * 
     */
    private $overview;
    /**
     * @var string
     *
     * 
     */
    private $propertyType;
    /**
     * @var integer
     *
     * 
     */
    private $category;
    /**
     * @var string
     *
     * 
     */
    private $checkIn;
    /**
     * @var string
     *
     * 
     */
    private $checkOut;

    /**
     * @var float
     *
     *
     */
    private $price;

    /**
     * @var string
     *
     * 
     */
    private $city;

    /**
     * @var integer
     *
     * 
     */
    private $numRooms;
    /**
     * @var boolean
     *
     *
     */
    private $soldOut;
    /**
     * @var integer
     *
     *
     */
    private $priority;

    /**
     * @var integer
     *
     * 
     */
    private $cityId;
    /**
     * @var boolean
     *
     * 
     */
    private $active;
    
    /**
     * @var string
     *
     * 
     */
    private $addressLine1;
    
    /**
     * @var string
     *
     * 
     */
    private $addressLine2;
    
    /**
     * @var string
     *
     * 
     */
    private $location;
    
    /**
     * @var string
     *
     *
     */
    private $pincode;
    
    /**
     * @var Collection
     * 
     */
    protected $images;
    /**
     * @var Collection
     * 
     */
    protected $amenities;
    
    public function __construct() {
    	$this->images = new ArrayCollection();
    	$this->amenities = new ArrayCollection();
    }
	
	/**
	 *
	 * @return the integer
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 *
	 * @param
	 *        	$id
	 */
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 *
	 * @param
	 *        	$name
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getOverview() {
		return $this->overview;
	}
	
	/**
	 *
	 * @param
	 *        	$overview
	 */
	public function setOverview($overview) {
		$this->overview = $overview;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getPropertyType() {
		return $this->propertyType;
	}
	
	/**
	 *
	 * @param
	 *        	$propertyType
	 */
	public function setPropertyType($propertyType) {
		$this->propertyType = $propertyType;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getCategory() {
		return $this->category;
	}
	
	/**
	 *
	 * @param
	 *        	$category
	 */
	public function setCategory($category) {
		$this->category = $category;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCheckIn() {
		return $this->checkIn;
	}
	
	/**
	 *
	 * @param
	 *        	$checkIn
	 */
	public function setCheckIn($checkIn) {
		$this->checkIn = $checkIn;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCheckOut() {
		return $this->checkOut;
	}
	
	/**
	 *
	 * @param
	 *        	$checkOut
	 */
	public function setCheckOut($checkOut) {
		$this->checkOut = $checkOut;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getPrice() {
		return $this->price;
	}
	
	/**
	 *
	 * @param
	 *        	$price
	 */
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCity() {
		return $this->city;
	}
	
	/**
	 *
	 * @param
	 *        	$city
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getNumRooms() {
		return $this->numRooms;
	}
	
	/**
	 *
	 * @param
	 *        	$numRooms
	 */
	public function setNumRooms($numRooms) {
		$this->numRooms = $numRooms;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getCityId() {
		return $this->cityId;
	}
	
	/**
	 *
	 * @param
	 *        	$cityId
	 */
	public function setCityId($cityId) {
		$this->cityId = $cityId;
		return $this;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function getActive() {
		return $this->active;
	}
	
	/**
	 *
	 * @param
	 *        	$active
	 */
	public function setActive($active) {
		$this->active = $active;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getAddressLine1() {
		return $this->addressLine1;
	}
	
	/**
	 *
	 * @param
	 *        	$addressLine1
	 */
	public function setAddressLine1($addressLine1) {
		$this->addressLine1 = $addressLine1;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getAddressLine2() {
		return $this->addressLine2;
	}
	
	/**
	 *
	 * @param
	 *        	$addressLine2
	 */
	public function setAddressLine2($addressLine2) {
		$this->addressLine2 = $addressLine2;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getLocation() {
		return $this->location;
	}
	
	/**
	 *
	 * @param
	 *        	$location
	 */
	public function setLocation($location) {
		$this->location = $location;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getPincode() {
		return $this->pincode;
	}
	
	/**
	 *
	 * @param
	 *        	$pincode
	 */
	public function setPincode($pincode) {
		$this->pincode = $pincode;
		return $this;
	}
	
	
	/**
	 *
	 * @return the Collection
	 */
	public function getImages() {
		return $this->images;
	}
	
	/**
	 *
	 * @param
	 *        	$images
	 */
	public function setImages($images) {
		$this->images = $images;
		return $this;
	}
	
	/**
	 *
	 * @return the Collection
	 */
	public function getAmenities() {
		return $this->amenities;
	}
	
	/**
	 *
	 * @param
	 *        	$amenities
	 */
	public function setAmenities($amenities) {
		$this->amenities = $amenities;
		return $this;
	}
	
	/**
	 *
	 * @return the boolean
	 */
	public function getSoldOut() {
		return $this->soldOut;
	}
	
	/**
	 *
	 * @param
	 *        	$soldOut
	 */
	public function setSoldOut($soldOut) {
		$this->soldOut = $soldOut;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getPriority() {
		return $this->priority;
	}
	
	/**
	 *
	 * @param
	 *        	$priority
	 */
	public function setPriority($priority) {
		$this->priority = $priority;
		return $this;
	}
	
	
	
	   

    
}
