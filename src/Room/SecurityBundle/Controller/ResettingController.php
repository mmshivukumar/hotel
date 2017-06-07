<?php
namespace Room\SecurityBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\ResettingController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
/**
 * This is a ResettingController for resetting the password in
 */
class ResettingController extends BaseController
{
    
	
	/**
	 * Reset user password
	 */
	public function resetAction(Request $request, $token)
	{
		
		//echo 'hi';
		//exit();
		/** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
		$formFactory = $this->container->get('fos_user.resetting.form.factory');
		/** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
		$userManager = $this->container->get('fos_user.user_manager');
		/** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
		$dispatcher = $this->container->get('event_dispatcher');
	
		$user = $userManager->findUserByConfirmationToken($token);
	
		if (null === $user) {
			return $this->container->get('templating')->renderResponse('RoomSecurityBundle:Registration:link_error.html.'.$this->getEngine());
			//throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
		}
	
		$event = new GetResponseUserEvent($user, $request);
		$dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_INITIALIZE, $event);
	
		if (null !== $event->getResponse()) {
			return $event->getResponse();
		}
	
		$form = $formFactory->createForm();
		$form->setData($user);
	
		if ('POST' === $request->getMethod()) {
			$form->bind($request);
	
			if ($form->isValid()) {
				$event = new FormEvent($form, $request);
				$dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_SUCCESS, $event);
	
				$userManager->updateUser($user);
	
				if (null === $response = $event->getResponse()) {
					$url = $this->container->get('router')->generate('fos_user_profile_show');
					$response = new RedirectResponse($url);
				}
	
				$dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
	
				return $response;
			}
		}
	
		return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:reset.html.twig',  array(
				'token' => $token,
				'form' => $form->createView(),
		));
	}
	
    
}