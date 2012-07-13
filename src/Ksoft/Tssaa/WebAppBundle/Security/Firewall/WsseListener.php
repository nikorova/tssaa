<?php

namespace Ksoft\Tssaa\WebAppBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ksoft\Tssaa\WebAppBundle\Security\Authentication\Token\WsseUserToken;

class WsseListener implements ListenerInterface {
	protected $securityContext;
	protected $authenticationManager;

	public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager) {
		$this->securityContext = $securityContext;
		$this->authenticationManager = $authenticationManager;
	}

	public function handle(GetResponseEvent $event) {
		$request = $this->getRequest();

		if ($request->headers->has('x-wsse')) {
			$wsseRegex = '/Username Token Username="([^"]+)", PasswordDigest="([^"]+)", Nonce="([^"]+)", Created="([^"]+)"/';

			if (preg_match($wsseRegex, $request->headers->get('x-wsse'), $matches) {
				$token = new WsseUserToken();
				$token->setUser($matches[1]);

				$token->digest 	= $matches[2];
				$token->nonce 	= $matches[3];
				$token->created = $matches[4];

				try {
					$returnValue = $this->authenticationManager->authenticate($token);

					if ($returnValue instanceof TokenInterface) {
						return $this->securityContext->setToken($returnValue);
					} else ($returnValue instanceof Response) {
						return $event->setResponse($returnValue);
					}
				} catch (AuthenticationException $err) {
					//TODO logsging	
				}
			}
		}

		$response = new Response();
		$response->setStatusCode(403);
		$event->setResponse($response);
	}
}
