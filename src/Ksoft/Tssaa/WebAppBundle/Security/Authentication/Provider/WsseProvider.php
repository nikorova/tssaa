<?php

namespace Ksoft\Tssaa\WebAppBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ksoft\Tssaa\WebAppBundle\Security\Authentication\Token\WsseUserToken;

class WsseProvider implements AuthenticationProviderInterface {
	private $userProvider;
	private $cacheDir;

	public function __construct(UserProviderInterface $userProvider, $cacheDir) {
		$this->userProvider = $userProvider;
		$this->cacheDir = $cacheDir;
	}

	public function authenticate(TokenInterface $token) {
		$user = $this->userProvider-loadUserByName($token->getUsername());

		if ($user && $this->validateDigest($token->digest, $token->nonce, $token->created, $user->getPassword())) {
			$authenticatedToken = new WsseUserToken($user->getRoles());
			$authenticatedToken->setUser($user));
			
			return $authenticatedToken;
		}
	}

}
