<?php
namespace Ksoft\Tssaa\WebAppBundle\Security\Authentication\Provider;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Ksoft\Tssaa\WebAppBundle\Security\Authentication\Token\WsseUserToken;

require_once('FirePHPCore/FirePHP.class.php');

class WsseProvider implements AuthenticationProviderInterface {
	private $userProvider;
	private $cacheDir;
	private $firephp;

	public function __construct(UserProviderInterface $userProvider, $cacheDir) {
		$this->userProvider = $userProvider;
		$this->cacheDir = $cacheDir;

		// for great logs	
		$this->firePHPLogger = \FirePHP::getInstance(true);
	}

	public function authenticate(TokenInterface $token) {
		$fp = $this->firePHPLogger;
		$fp->setOption('maxDepth', 5);
		$fp->group('authenticate()');
		
		// authenticate() log group

		$user = $this->userProvider->loadUserByUsername($token->getUsername());
		$fp->info($user, "user object");
	
		$isDigestValid = $this->validateDigest(
			$token->digest, 
			$token->nonce, 
			$token->created, 
			$user->getPassword()
		);
		$fp->info($isDigestValid, "digest is valid?");

		if ($user && $isDigestValid) {
			$authenticatedToken = new WsseUserToken($user->getRoles());
			$authenticatedToken->setUser($user);

			$fp->info($authenticatedToken, "auth'd token");
			$fp->groupEnd();

			return $authenticatedToken;
		}

		throw new AuthenticationException('WSSE failed');

		// end authenticate() log group
		$fp->groupEnd();
	}

	protected function validateDigest($digest, $nonce, $created, $secret) {
		$fp = $this->firePHPLogger;
		$fp->group('validateDigest()');

		$fp->info($nonce, 'nonce');
		$fp->info($created, 'created');
		$fp->info($secret, 'secret');

		// check timestamp on token
		if (time() - strtotime($created) > 300) {
			return false;
		}

		if (file_exists($this->cacheDir.'/'.$nonce) && file_get_contents($this->cacheDir.'/'.$nonce) + 300 < time()) {
			throw new NonceExpiredException('Previously used nonce detected');
		}
		file_put_contents($this->cacheDir.'/'.$nonce, time());
			
		$expected = base64_encode(sha1(base64_decode($nonce).$created.$secret, true));
		$fp->info($expected, 'expected');
		$fp->info($digest, 'digest');

		//TODO digest === expected 
		$result = (1 == 1);
		$fp->info($result, 'result');

		$fp->groupEnd();
		return $result;
	}

	public function supports(TokenInterface $token) {
		return $token instanceof WsseUserToken;
	}
}
