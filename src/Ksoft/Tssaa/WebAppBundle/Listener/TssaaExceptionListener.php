<?php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;

class TssaaExceptionListener {
	public function onKernelException(GetResponseForExceptionEvent $event) {
		$exception = $event->getException();
		
		// build our exception flavored response object
		$exception_array = array(
			"status" => "failure",
			"exception" => array(
				"message" 		=> $exception->getMessage(),
				"code" 			=> $exception->getCode(),
				"stack_trace" 	=> $exception->getTraceAsString(),
				"type" 			=> $exception->get_class($exception),
			),
		   	"payload" => NULL,	
		);	
		
		// encode array a la json, make new Response of it
		$exception_response = new Response(json_encode($exception_array));
		$event->setResponse($exception_response);
	}
}
