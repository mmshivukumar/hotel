<?php

namespace Room\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity
 */
class Booking
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var integer
     * @ORM\Column(name="customer_id", type="integer")
     */
    private $customerId;
    /**
     * @var integer
     * @ORM\Column(name="booking_id",type="string", length=100)
     */
    private $bookingId;
    /**
     * @var integer
     * @ORM\Column(name="total_price", type="float")
     */
    private $totalPrice;   
    /**
     * @var string
     * @ORM\Column(name="discount", type="float")
     */
    private $discount;
    /**
     * @var integer
     * @ORM\Column(name="final_price", type="float")
     */
    private $finalPrice;
    /**
     * Tax
     * @ORM\Column(name="service_tax", type="float")
     */
     private $serviceTax;
    /**
     * @var float
     *
     * @ORM\Column(name="swach_bharth_cess", type="float")
     */
    private $swachBharthCess;

    /**
     * @var float
     *
     * @ORM\Column(name="krishi_kalyan_cess", type="float")
     */
    private $krishiKalyanCess;
    /**
     * @var integer
     * @ORM\Column(name="amount_paid", type="float")
     */
    private $amountPaid;
    /**
     * @var integer
     * @ORM\Column(name="payment_id", type="string", length=100)
     */
    private $paymentId;
    /**
     * @var string
     * @ORM\Column(name="coupon_code", type="string", length=100)
     */
    private $couponCode; 
    /**
     * @var string
     * @ORM\Column(name="is_coupon_applyed", type="boolean")
     */
    private $couponApplyed; 
    /**
     * @var string
     * @ORM\Column(name="num_of_days", type="integer")
     */
    private $numDays;
    /**
     * @var integer
     * @ORM\Column(name="num_of_adult", type="integer")
     */
    private $numAdult;
    /**
     * @var integer
     * @ORM\Column(name="num_of_rooms", type="integer")
     */
    private $numRooms;
    /**
     * @var string
     * @ORM\Column(name="chek_in", type="date")
     */
    private $chekIn;    
    /**
     * @var string
     * @ORM\Column(name="chek_out", type="date")
     */
    private $chekOut;
    
    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;   
    /**
     * @var string
     * @ORM\Column(name="job_status", type="string", length=100)
     */
    private $jobStatus;
    
    /**
     * @var string
     * @ORM\Column(name="booked_on", type="date")
     */
    private $bookedOn;
    /**
     * @var integer
     * @ORM\Column(name="payment_mode", type="string")
     */
    private $paymentMode;
    
    /**
     * @var integer
     * @ORM\Column(name="hotel_id", type="integer")
     */
    private $hotelId;
    /**
     * @var string
     * @ORM\Column(name="hotel_name", type="string", length=100)
     */
    private $hotelName;
    /**
     * @var string
     * @ORM\Column(name="location", type="integer")
     */
    private $location;
	
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
	 * @return the integer
	 */
	public function getCustomerId() {
		return $this->customerId;
	}
	
	/**
	 *
	 * @param
	 *        	$customerId
	 */
	public function setCustomerId($customerId) {
		$this->customerId = $customerId;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getBookingId() {
		return $this->bookingId;
	}
	
	/**
	 *
	 * @param
	 *        	$bookingId
	 */
	public function setBookingId($bookingId) {
		$this->bookingId = $bookingId;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getTotalPrice() {
		return $this->totalPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$totalPrice
	 */
	public function setTotalPrice($totalPrice) {
		$this->totalPrice = $totalPrice;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDiscount() {
		return $this->discount;
	}
	
	/**
	 *
	 * @param
	 *        	$discount
	 */
	public function setDiscount($discount) {
		$this->discount = $discount;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getFinalPrice() {
		return $this->finalPrice;
	}
	
	/**
	 *
	 * @param
	 *        	$finalPrice
	 */
	public function setFinalPrice($finalPrice) {
		$this->finalPrice = $finalPrice;
		return $this;
	}
	
	/**
	 *
	 * @return the unknown_type
	 */
	public function getServiceTax() {
		return $this->serviceTax;
	}
	
	/**
	 *
	 * @param unknown_type $serviceTax        	
	 */
	public function setServiceTax($serviceTax) {
		$this->serviceTax = $serviceTax;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getSwachBharthCess() {
		return $this->swachBharthCess;
	}
	
	/**
	 *
	 * @param
	 *        	$swachBharthCess
	 */
	public function setSwachBharthCess($swachBharthCess) {
		$this->swachBharthCess = $swachBharthCess;
		return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getKrishiKalyanCess() {
		return $this->krishiKalyanCess;
	}
	
	/**
	 *
	 * @param
	 *        	$krishiKalyanCess
	 */
	public function setKrishiKalyanCess($krishiKalyanCess) {
		$this->krishiKalyanCess = $krishiKalyanCess;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getAmountPaid() {
		return $this->amountPaid;
	}
	
	/**
	 *
	 * @param
	 *        	$amountPaid
	 */
	public function setAmountPaid($amountPaid) {
		$this->amountPaid = $amountPaid;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getPaymentId() {
		return $this->paymentId;
	}
	
	/**
	 *
	 * @param
	 *        	$paymentId
	 */
	public function setPaymentId($paymentId) {
		$this->paymentId = $paymentId;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCouponCode() {
		return $this->couponCode;
	}
	
	/**
	 *
	 * @param
	 *        	$couponCode
	 */
	public function setCouponCode($couponCode) {
		$this->couponCode = $couponCode;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getCouponApplyed() {
		return $this->couponApplyed;
	}
	
	/**
	 *
	 * @param
	 *        	$couponApplyed
	 */
	public function setCouponApplyed($couponApplyed) {
		$this->couponApplyed = $couponApplyed;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getNumDays() {
		return $this->numDays;
	}
	
	/**
	 *
	 * @param
	 *        	$numDays
	 */
	public function setNumDays($numDays) {
		$this->numDays = $numDays;
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
	 * @return the string
	 */
	public function getChekIn() {
		return $this->chekIn;
	}
	
	/**
	 *
	 * @param
	 *        	$chekIn
	 */
	public function setChekIn($chekIn) {
		$this->chekIn = $chekIn;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getChekOut() {
		return $this->chekOut;
	}
	
	/**
	 *
	 * @param
	 *        	$chekOut
	 */
	public function setChekOut($chekOut) {
		$this->chekOut = $chekOut;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 *
	 * @param
	 *        	$status
	 */
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getJobStatus() {
		return $this->jobStatus;
	}
	
	/**
	 *
	 * @param
	 *        	$jobStatus
	 */
	public function setJobStatus($jobStatus) {
		$this->jobStatus = $jobStatus;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getBookedOn() {
		return $this->bookedOn;
	}
	
	/**
	 *
	 * @param
	 *        	$bookedOn
	 */
	public function setBookedOn($bookedOn) {
		$this->bookedOn = $bookedOn;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getPaymentMode() {
		return $this->paymentMode;
	}
	
	/**
	 *
	 * @param
	 *        	$paymentMode
	 */
	public function setPaymentMode($paymentMode) {
		$this->paymentMode = $paymentMode;
		return $this;
	}
	
	/**
	 *
	 * @return the integer
	 */
	public function getHotelId() {
		return $this->hotelId;
	}
	
	/**
	 *
	 * @param
	 *        	$hotelId
	 */
	public function setHotelId($hotelId) {
		$this->hotelId = $hotelId;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getHotelName() {
		return $this->hotelName;
	}
	
	/**
	 *
	 * @param
	 *        	$hotelName
	 */
	public function setHotelName($hotelName) {
		$this->hotelName = $hotelName;
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
	
    
    
   
            
}
