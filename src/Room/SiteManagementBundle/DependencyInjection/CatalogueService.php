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
    public function getHotels(){
    	$locations = $this->em->getRepository('RoomHotelBundle:Hotel')->findAll();
    	return $locations;
    }
    public function getHotelsByCity($city){
    	$locations = $this->em->getRepository('RoomHotelBundle:Hotel')->findByCityId($city);
    	return $locations;
    }	
	
}
