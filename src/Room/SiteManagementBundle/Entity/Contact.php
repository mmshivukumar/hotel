<?php

namespace Room\SiteManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a Entity to hold the data of Contact in
 *
 * Contact
 * @ORM\Table(name="contact_us")
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=50)
     * @Assert\Length(max = 100, maxMessage="Your Name cannot contain more then 50")
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z&]+([s ][A-Za-z&]+)*$/",
     *     match=true,
     *     message="Please enter a valid Name"
     * )
     */
    private $name;
    /**
     * @ORM\Column(name="email", type="string", length=50)
     * @Assert\Email(
     *     message = "The email-id '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

     /**
     * @var string
     * @ORM\Column(name="mobile", type="string", length=100)
     * @Assert\Length(min = 10, max = 15, maxMessage="Your mobile cannot contain more then 15")
     * @Assert\Regex(
     *     pattern="/^([+0-9]{1,3})?([0-9]{10,12})$/i",
     *     message= "Invalid mobile no."
     * )
     */
    private $mobile;
    /**
     * @var string
     * @ORM\Column(name="subject", type="string", length=100)
     */
    private $subject;
   /**
     * @ORM\Column(name="message", type="string", length=100)
     * @Assert\Length(max = 5000, maxMessage="Your address cannot contain more then 1000 Characters")
     * @var string
     * 
     */
    private $message;
	
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
	 * @return the unknown_type
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 *
	 * @param unknown_type $email        	
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMobile() {
		return $this->mobile;
	}
	
	/**
	 *
	 * @param
	 *        	$mobile
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getSubject() {
		return $this->subject;
	}
	
	/**
	 *
	 * @param
	 *        	$subject
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMessage() {
		return $this->message;
	}
	
	/**
	 *
	 * @param
	 *        	$message
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	
	
	
}
