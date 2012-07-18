<?php
namespace Ksoft\Tssaa\WebAppBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ksoft\Tssaa\WebAppBundle\Security\Authentication\Token\WsseUserToken;

require_once('firelogger.php/firelogger.php');

class WsseProvider implements AuthenticationProviderInterface {
	private $userProvider;
	private $cacheDir;
	private $firephp;

	public function __construct(UserProviderInterface $userProvider, $cacheDir) {
		$this->userProvider = $userProvider;
		$this->cacheDir = $cacheDir;

		// for great logs	
		$this->fireLogger = new \FireLogger('WsseProvider');
	}

	public function authenticate(TokenInterface $token) {
		$fl = $this->fireLogger;
		
		// authenticate() log group

		$user = $this->userProvider->loadUserByUsername($token->getUsername());
		$fl->log($user, "user object");
	
		$isDigestValid = $this->validateDigest(
			$token->digest, 
			$token->nonce, 
			$token->created, 
			$user->getPassword()
		);
		$fl->log($isDigestValid, "digest is valid?");

		if ($user && $isDigestValid) {
			$authenticatedToken = new WsseUserToken($user->getRoles());
			$authenticatedToken->setUser($user);

			$fl->log($authenticatedToken, "auth'd token");

			return $authenticatedToken;
		}

		throw new AuthenticationException('WSSE failed');
	}

	protected function validateDigest($digest, $nonce, $created, $secret) {
		$fl = $this->fireLogger;

		$fl->log($nonce, 'nonce');
		$fl->log($created, 'created');
		$fl->log($secret, 'secret');

		// check timestamp on token
		if (time() - strtotime($created) > 300) {
			return false;
		}

		if (file_exists($this->cacheDir.'/'.$nonce) && 
			file_get_contents($this->cacheDir.'/'.$nonce) 
			+ 300 < time()
		) {
			throw new NonceExpiredException('Previously used nonce detected');
		}
		file_put_contents($this->cacheDir.'/'.$nonce, time());

		$unShaString = base64_decode($nonce).$created.$secret;
		$fl->log($unShaString, 'unShaString');

		$expected = base64_encode(sha1($unShaString, true));
		$fl->log($expected, 'expected');
		$fl->log($digest, 'digest');

		//TODO digest === expected 
		$result = (1 == 1);
		$fl->log($result, 'result');

		return $result;
	}

	public function supports(TokenInterface $token) {
		return $token instanceof WsseUserToken;
	}
}
