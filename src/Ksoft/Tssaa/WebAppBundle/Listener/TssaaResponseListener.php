<?php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseforControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class TssaaResponseListener {
	public function onKernelResponse (GetResponseForControllerResultEvent $event) {
		$server_data = array(
			"status" => "success",
			"exception" => NULL,
			"payload" => $event->getControllerResult(),
		);

		$response = new Response(json_encode($server_data));

		$event->setResponse($response);
	}
}

