<?php

namespace Room\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Hotel
 *
 * @ORM\Table(name="hotel")
 * @ORM\Entity
 */
class Hotel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="string", length=3000)
     */
    private $overview;
    /**
     * @var string
     *
     * @ORM\Column(name="property_type", type="string", length=50)
     */
    private $propertyType;
    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="integer")
     */
    private $category;
    /**
     * @var string
     *
     * @ORM\Column(name="check_in", type="string", length=100)
     */
    private $checkIn;
    /**
     * @var string
     *
     * @ORM\Column(name="check_out", type="string", length=100)
     */
    private $checkOut;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_rooms", type="integer")
     */
    private $numRooms;
       
    /**
     * @var boolean
     *
     * @ORM\Column(name="sold_out", type="boolean")
     */
    private $soldOut;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    private $cityId;
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    /**
     * @var Collection
     * @ORM\OneToOne(targetEntity="Room\HotelBundle\Entity\HotelAddress", mappedBy="hotel", cascade={"persist"})
     */
    protected $address;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Room\HotelBundle\Entity\HotelImage", mappedBy="hotel", cascade={"persist"})
     */
    protected $images;
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Room\HotelBundle\Entity\HotelAmenities", mappedBy="hotel", cascade={"persist"})
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
	 * @return the Collection
	 */
	public function getAddress() {
		return $this->address;
	}
	
	/**
	 *
	 * @param
	 *        	$address
	 */
	public function setAddress($address) {
		$this->address = $address;
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
