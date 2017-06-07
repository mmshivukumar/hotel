<?php

namespace Room\BookingEngineBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a DTO to hold the data of Search
 *
 *
 * Search
 */
class Search
{

	/**
	 * @var string
	 */
	private $city;
	/**
	 * @var date
	 */
	private $checkIn;
	/**
	 * @var date
	 */
	private $checkOut;
	/**
	 * @var integer
	 */
	private $numAdult;
	/**
	 * @var integer
	 */
	private $numChildren;
	
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
	 * @return the date
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
	 * @return the date
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
	 * @return the integer
	 */
	public function getNumAdult() {
		return $this->numAdult;
	}
	
	/**
	 *
	 * @param
	 *        	$numAdult
	 */
	public function setNumAdult($numAdult) {
		$this->numAdult = $numAdult;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getNumChildren() {
		return $this->numChildren;
	}
	
	/**
	 *
	 * @param
	 *        	$numChildren
	 */
	public function setNumChildren($numChildren) {
		$this->numChildren = $numChildren;
		return $this;
	}
	
	
	
}