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
	 * @var string
	 */
	private $location;
	/**
	 * @var integer
	 */
	private $categories;
	/**
	 * @var Collection
	 */
	private $amenities;
	/**
	 * @var Collection
	 */
	private $price;
	
	/**
	 * @var Collection
	 */
	private $minPrice;
	/**
	 * @var Collection
	 */
	private $maxPrice;
	/**
	 * @var Collection
	 */
	private $min;
	/**
	 * @var Collection
	 */
	private $max;
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
	private $numRooms;
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
	 * @return the integer
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 *
	 * @param
	 *        	$categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
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
	 * @return the Collection
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
	 * @return the Collection
	 */
	public function getMinPrice() {
		return $this->minPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$minPrice
	 */
	public function setMinPrice($minPrice) {
		$this->minPrice = $minPrice;
		return $this;
	}
	
	/**
	 *
	 * @return the Collection
	 */
	public function getMaxPrice() {
		return $this->maxPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$maxPrice
	 */
	public function setMaxPrice($maxPrice) {
		$this->maxPrice = $maxPrice;
		return $this;
	}
	
	/**
	 *
	 * @return the Collection
	 */
	public function getMin() {
		return $this->min;
	}
	
	/**
	 *
	 * @param
	 *        	$min
	 */
	public function setMin($min) {
		$this->min = $min;
		return $this;
	}
	
	/**
	 *
	 * @return the Collection
	 */
	public function getMax() {
		return $this->max;
	}
	
	/**
	 *
	 * @param
	 *        	$max
	 */
	public function setMax($max) {
		$this->max = $max;
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