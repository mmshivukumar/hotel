<?php

namespace Room\BookingEngineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer
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
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=100)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=1000)
     */
    private $address;
    /**
     * @var string
     */
    private $haveCoupon;
    /**
     * @var string
     */
    private $couponCode; 
    /**
     * @var integer
     */

    private $paymentMode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
    
     /**
     * Set haveCoupon
     *
     * @param string $haveCoupon
     * @return Customer
     */
    public function setHaveCoupon($haveCoupon)
    {
        $this->haveCoupon = $haveCoupon;

        return $this;
    }

    /**
     * Get haveCoupon
     *
     * @return string 
     */
    public function getHaveCoupon()
    {
        return $this->haveCoupon;
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

     * Set paymentMode

     *

     * @param integer $paymentMode

     * @return paymentMode

     */

    public function setPaymentMode($paymentMode)

    {

    	$this->paymentMode = $paymentMode;

    

    	return $this;

    }

    

    /**

     * Get paymentMode

     *

     * @return string

     */

    public function getPaymentMode()

    {

    	return $this->paymentMode;

    }

}
