<?php

namespace Room\SecurityBundle\Controller;
 
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
/**
 * This is a LoginSuccessHandler to decide where to go based on role
 *
 */
class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{
    
    protected $router;
    protected $security;
    
    public function __construct(Router $router, SecurityContext $security)
    {
    	
    	$this->router = $router;
        $this->security = $security;
    }
   /**
    * 
    * @param Request $request
    * @param TokenInterface $token
    * @return \Symfony\Component\HttpFoundation\RedirectResponse
    */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
    	$session = $request->getSession ();
        if ($this->security->isGranted('ROLE_SUPER_ADMIN'))
        {
        	
            $response = new RedirectResponse($this->router->generate('room_booking_engine_homepage'));            
        }
        elseif ($this->security->isGranted('ROLE_ADMIN'))
        {
			
            $response = new RedirectResponse($this->router->generate('room_booking_engine_homepage'));
        } 
        elseif ($this->security->isGranted('ROLE_USER'))
        {
            // redirect the user to where they were before the login process begun.
          
        	$selectedService = $session->get('selected');
        		if($selectedService)
        		{
        			$url = $this->router->generate('room_booking_engine_booking');
        			
        		}
        		else{
					$referer = $request->headers->get('referer');
					$referer = null;
					if ($referer == NULL) {
						$url = $this->router->generate('room_booking_engine_homepage');
					} else {
						$url = $referer;
					}
        		}
				

                  
            $response = new RedirectResponse($url);
        }
            
        return $response;
    }
    /**
     * 
     * @param Request $request
     * @param AuthenticationException $exception
     * @return \Room\SecurityBundle\Controller\Response|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public  function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        if($request->isXmlHttpRequest()){
        	$session = $request->getSession();
        	$session->set('loginfail',false);
            $response = new Response(json_encode(array(
                'success'=> 0,
            )));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }else{
            $session = $request->getSession();
            $session->set('error', $exception->getMessage());
            $session->set('csrf', $request->get('_csrf_token'));
            $session->set('last_username', $request->get('_username'));
            $session->set('loginfail',true);
            $session->set('regFail',false);
                return new RedirectResponse($this->router->generate('room_security_user_login'));

        }
    }

}