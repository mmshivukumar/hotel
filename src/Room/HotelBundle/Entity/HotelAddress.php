<?php

namespace Room\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * HotelAddress
 *
 * @ORM\Table(name="hotel_address")
 * @ORM\Entity
 */
class HotelAddress
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
     * @ORM\Column(name="address_line1", type="string", length=100)
     */
    private $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line2", type="string", length=100)
     */
    private $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100)
     */
    private $location;
    
   /**
     * @var string
     *
     * @ORM\Column(name="pincode", type="string", length=100)
     */
    private $pincode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100)
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer")
     */
    private $cityId;    
    /**
     * @ORM\OneToOne(targetEntity="Room\HotelBundle\Entity\Hotel", inversedBy="address")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    protected $hotel;
	
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
	 * @return the unknown_type
	 */
	public function getHotel() {
		return $this->hotel;
	}
	
	/**
	 *
	 * @param unknown_type $hotel        	
	 */
	public function setHotel($hotel) {
		$this->hotel = $hotel;
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
		    
}
