<?php
namespace Room\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
/**
 * This is a RegistrationController for all the login detail in
 */
class RegistrationController extends BaseController
{
	/**
	 * 
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->createUser();

        $referer = $request->headers->get('referer');

        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);
        $session = $request->getSession();
        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
            	$session->set('regFail',false);
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);



                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
            else
            {
               
                $session->set('regFail',true);
                $session->set('loginfail',false);
                return $this->render('RoomSecurityBundle:Default:login.html.twig', array(
                		'form' => $form->createView(),
                ));
            }
        }
        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
        		'form' => $form->createView(),
        ));
    }
    /**
     * 
     * @param Request $request
     * @param unknown $token
     */
    public function confirmAction(Request $request, $token)
    {
    	$userManager = $this->container->get('fos_user.user_manager');
    
    	$user = $userManager->findUserByConfirmationToken($token);
    
    	if (null === $user) {
    
    		/* ************************************
    		 *
    		* User with token not found. Do whatever you want here
    		*
    		* e.g. redirect to login:
    		**************************************/
    		
    		//return $this->container->get('templating')->renderResponse('DriveHomeBundle:Registration:link_error.html.twig');
    		
    		return $this->render('RoomSecurityBundle:Registration:link_error.html.twig');
    
    	}
    	else{
    		// Token found. Letting the FOSUserBundle's action handle the confirmation
    		return parent::confirmAction($request, $token);
    	}
    }
    
    
}