<?php

namespace NetteOpauth\DI;


class Extension extends Nette\Config\CompilerExtension
{
	/**
	 * @var array
	 */
	public $defaults = array(
		'login_action' => 'Homepage:default',
		'logout_action' => 'Homepage:default',
		'path' => '/auth/',
		'callback_url' => '{path}callback',
		'security_salt' => '123abc456def',
		'debug' => true,
	);

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);

		$builder->addDefinition($this->prefix('opauth'))
			->setClass('\Elemedia\Opauth\Opauth', array($config));
	}
}



































