<?php

namespace Elemedia\Opauth;

use Nette\Application\Routers\Route;


class Opauth 
{
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
