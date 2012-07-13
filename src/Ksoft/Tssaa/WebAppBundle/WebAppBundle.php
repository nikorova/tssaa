<?php

namespace Ksoft\Tssaa\WebAppBundle;

use Ksoft\Tssaa\WebAppBundle\Security\Factory\WsseFactory;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class WebAppBundle extends Bundle {
	public function build(ContainerBuilder $container) {
		parent::build($container);

		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new WsseFactory());
	}
}
