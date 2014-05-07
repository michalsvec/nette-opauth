<?php

namespace NetteOpauth;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Diagnostics\Debugger;
use NetteOpauth\Security\BaseIdentity;
use NetteOpauth\Security\FacebookIdentity;
use NetteOpauth\Security\GoogleIdentity;
use NetteOpauth\Security\TwitterIdentity;
use NetteOpauth\Security\LinkedinIdentity;

/**
 * Init class to plug into Nette framework
 *
 * @author  Michal Svec <pan.svec@gmail.com>
 */
class NetteOpauth
{
	/**
	 * @var array
	 */
	protected $config;

	/**
	 * @param array $config
	 */
	public function __construct(array $config)
	{
		$this->config = $config;
	}

	/**
	 * @param  string $strategy
	 * @return bool
	 */
	private function isFakeStrategy($strategy)
	{
		return $strategy == 'fake';
	}

	/**
	 * Method which redirects to oauth provider
	 *
	 * @param string|null $strategy chosen strategy - f.e. "facebook". Can be "fake" to use on localhost
	 */
	public function auth($strategy)
	{
		// let the Opauth do the magic :)
		new \Opauth($this->config);
	}

	/**
	 * @param  string|null              $strategy
	 * @return IOpauthIdentity
	 * @throws InvalidArgumentException
	 * @throws InvalidLoginException
	 */
	public function callback($strategy)
	{
		if($this->isFakeStrategy($strategy)) {

			if($this->config['debug'] != true) {
				throw new InvalidLoginException("Fake login available only in debug mode!");
			}

			return $this->createIdentity(array(
				'uid' => "123123123",
				'info' => array(
					'name' => "Chuck Norris",
					'image' => "http://placekitten.com/465/465",
				),
				'raw' => array(
					'link' => "http://www.google.com/search?q=chuck+norris",
					'email' => "gmail@chucknorris.com",
					'given_name' => "Chuck",
					'family_name' => "Norris",
				),
				'provider' => 'Google'
			));
		}

		$Opauth = new \Opauth($this->config, false);

		$response = null;

		switch ($Opauth->env['callback_transport']) {
			case 'session':
				$response = $_SESSION['opauth'];
				unset($_SESSION['opauth']);
				break;
			case 'post':
				$response = unserialize(base64_decode($_POST['opauth']));
				break;
			case 'get':
				$response = unserialize(base64_decode($_GET['opauth']));
				break;
			default:
				throw new InvalidArgumentException("Unsupported callback transport.");
				break;
		}

		if (array_key_exists('error', $response)) {
			throw new InvalidLoginException($response['error']['message']);
		}

		if (empty($response['auth']) || empty($response['timestamp']) || empty($response['signature']) || empty($response['auth']['provider']) || empty($response['auth']['uid'])) {
			throw new InvalidLoginException('Invalid auth response: Missing key auth response components');
		} elseif (!$Opauth->validate(sha1(print_r($response['auth'], true)), $response['timestamp'], $response['signature'], $reason)) {
			throw new InvalidLoginException('Invalid auth response: ' . $reason);
		}

		\Nette\Diagnostics\Debugger::barDump($response['auth'], 'authInfo');

		return $this->createIdentity($response['auth']);
	}

	/**
	 * Function to register router for this extension
	 *
	 * @param IRouter $router
	 */
	public static function register($router)
	{
		$router[] = new Route('/auth/logout', 'Auth:logout');
		$router[] = new Route('/auth/callback', 'Auth:callback');
		$router[] = new Route('/auth/<strategy>', 'Auth:auth');
		$router[] = new Route('/auth/<strategy>/oauth2callback', 'Auth:auth');
		$router[] = new Route('/auth/<strategy>/oauth_callback', 'Auth:auth');
		$router[] = new Route('/auth/<strategy>/int_callback', 'Auth:auth');
	}

	/**
	 * @param  array $info  array returned from oauth provider
	 * @return IOpauthIdentity
	 */
	private function createIdentity($info)
	{
		switch($info['provider'])
		{
			case "Twitter":
				return new TwitterIdentity($info);
				break;
			case "Facebook":
				return new FacebookIdentity($info);
				break;
			case "Google":
				return new GoogleIdentity($info);
				break;
			case "Linkedin":
				return new LinkedinIdentity($info);
				break;
			default:
				return new BaseIdentity($info);
				break;
		}
	}
}


class InvalidLoginException extends \Exception {}
