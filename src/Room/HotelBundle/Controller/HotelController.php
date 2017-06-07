<?php

namespace Room\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HotelController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('RoomHotelBundle:Default:index.html.twig');
    }
}
