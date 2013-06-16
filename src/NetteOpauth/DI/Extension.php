<?php

namespace NetteOpauth\DI;


class Extension extends \Nette\Config\CompilerExtension
{
	/**
	 * @var array
	 */
	public $defaults = array(
		'path' => '/auth/',
		'callback_url' => '{path}callback',
		'security_salt' => '123abc456def',
		'debug' => false,
	);

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$builder = $this->getContainerBuilder();

		$opauth = $builder->addDefinition($this->prefix('opauth'));
		$opauth->setClass('NetteOpauth\NetteOpauth');
		$opauth->addSetup('setConfig', $config);
	}
}
