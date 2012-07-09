<?php
// src/Ksoft/Tssaa/WebAppBundle/Listener/TssaaRequestListener.php
namespace Ksoft\Tssaa\WebAppBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Request;

class TssaaRequestListener {
	public function onKernelRequest(GetResponseEvent $event) {
		// get client json string from incoming Request
		$req = $event->getRequest();
		$req_data = $req->getContent();

		// Letting this exception bubble up
		$decoded = json_decode($req_data, true);

		// stick decoded and arrayified client data in Request's
		// parameter bag
		$p_bag = $req->request;
		$p_bag->set("parameter_bag_test_key", "parameter_bag_test_value");
		$p_bag->set("client_data", $decoded);	
	}
}
?>
