<?php

namespace Elemedia\Opauth;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;

/**
 * Init class to plug into Nette framework
 *
 * @author  Michal Svec <pan.svec@gmail.com>
 * @package Elemedia\Opauth
 */
class Opauth 
{
	/**
	 * Function to registeer router for this extension
	 *
	 * @param IRouter $router
	 */
	public static function register($router)
	{
		// opauth URLs
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
	public static function createIdentity($info)
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
		}
	}
}
