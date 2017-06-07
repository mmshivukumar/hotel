<?php

namespace Room\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
    
    	$request = $this->container->get('request');
    	$session = $request->getSession();
    	$session->set('regFail',false);
    	$error =$session->get('error');
    	if(!$error)
    	{
    		$session->set('loginfail',false);
    	}
    	$csrf_token=$session->get('csrf');
    	$last_username=$session->get('last_username');
    	return $this->render('RoomSecurityBundle:Default:login.html.twig',array('error'=>$error,
    			'last_username'=>$last_username,
    			'csrf_token'=>$csrf_token,
    	));
    }
}
