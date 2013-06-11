<?php


namespace Elemedia\Opauth;


class BaseIdentity extends \Nette\Security\Identity 
{
	protected $data;

	public function __construct($info)
	{
		$this->data = array_merge($info['info'], $info['raw']);
		parent::__construct($info['uid'], null, $this->data);
	}
}
