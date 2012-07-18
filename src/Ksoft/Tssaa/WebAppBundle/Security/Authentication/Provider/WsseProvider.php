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
		
		// authenticate() log group
		$fp->group('authenticate()');
		ob_start();

		$user = $this->userProvider->loadUserByUsername($token->getUsername());
		$fp->info($user, "user object");
	
		$isDigestValid = $this->validateDigest(
			$token->digest, 
			$token->nonce, 
			$token->created, 
			$user->getPassword()
		);

		if ($user && $isDigestValid) {
			$authenticatedToken = new WsseUserToken($user->getRoles());
			$authenticatedToken->setUser($user);

			return $authenticatedToken;
		}
		$fp->info($isDigestValid, "digest is valid?");

		throw new AuthenticationException('WSSE failed');

		// end authenticate() log group
		$fp->groupEnd(); 
		ob_end_flush();
	}

	protected function validateDigest($digest, $nonce, $created, $secret) {
		$fp = $this->firePHPLogger;
		$fp->group('validateDigest()');
		ob_start();

		$fp->info($nonce, 'nonce');
		$fp->info($created, 'created');
		$fp->info($secret, 'secret');

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

		$result = (1 == 1);
		$fp->info($result, 'result');

		$fp->groupEnd();
		ob_end_flush();
		return $result;
	}

	public function supports(TokenInterface $token) {
		return $token instanceof WsseUserToken;
	}
}
