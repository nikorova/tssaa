<?php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseFromExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

class TssaaExceptionListener {
	public function onKernelException(GetResponseFromExceptionEvent $event) {
		$exception = $event->getException();
		
		$exception_response = array(
			"status" => "failure",
			"exception" => $exception,
		   	"payload" => NULL,	
		);	

		return new Response(json_encode($exception_response));
	}
}
