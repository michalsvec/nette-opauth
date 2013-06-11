<?php

namespace Elemedia\Opauth;

/**
 * Common methods for all identity wrappers
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class BaseIdentity extends \Nette\Security\Identity 
{
	/**
	 * $data in parent class are private, necessary own container
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Data returned from oauth server
	 *
	 * @param array $info
	 */
	public function __construct($info)
	{
		$this->data = array_merge($info['info'], $info['raw']);
		parent::__construct($info['uid'], null, $this->data);
	}
}
