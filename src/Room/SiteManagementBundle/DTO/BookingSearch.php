<?php

namespace Room\SiteManagementBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * This is a DTO to hold the data of Search
 * BookingSearch
 */
class BookingSearch
{

	/**
	 * @var date
	 */
	private $from;
	/**
	 * @var date
	 */
	private $to;
	
	/**
	 *
	 * @return the date
	 */
	public function getFrom() {
		return $this->from;
	}
	
	/**
	 *
	 * @param
	 *        	$from
	 */
	public function setFrom($from) {
		$this->from = $from;
		return $this;
	}
	
	/**
	 *
	 * @return the date
	 */
	public function getTo() {
		return $this->to;
	}
	
	/**
	 *
	 * @param
	 *        	$to
	 */
	public function setTo($to) {
		$this->to = $to;
		return $this;
	}
	
	
	
}