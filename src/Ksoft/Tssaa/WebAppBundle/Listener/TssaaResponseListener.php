<?php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseforControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

require_once('firelogger.php/firelogger.php');

class TssaaResponseListener {
	public function onKernelResponse (GetResponseForControllerResultEvent $event) {
		$fl = new \FireLogger('TssaaResponseListener');
		$fl->log('event', $event);

		$server_data = array(
			"status" => "success",
			"exception" => NULL,
			"payload" => $event->getControllerResult(),
		);
		
		$response = new Response(json_encode($server_data));

		$event->setResponse($response);
	}
}

