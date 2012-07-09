<?php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseforControllerEvent;
use Symfony\Component\HttpKernel\Response;

class TssaaResponseListener {
	public function onKernelResponse (GetResponseForControllerResultEvent $event) {
		$server_data = $event->getControllerResult();

		$response = new Response(json_encode($server_data));

		$event->setResponse($response);
	}
}

