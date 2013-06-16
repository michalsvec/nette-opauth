<?php

namespace NetteOpauth\Security;

/**
 * Common methods for all identity wrappers
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class BaseIdentity extends \Nette\Security\Identity implements IOpauthIdentity
{
	/**
	 * $data in parent class are private, but it's needed to get data from response
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

	/**
	 * {@inheritdoc}
	 */
	public function getProvider()
	{
		return "Generic";
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->data['name'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getImage()
	{
		return $this->data["image"];
	}

	/**
	 * {@inheritdoc}
	 */
	public function getProfileUrl()
	{
		return $this->data["link"];
	}
}
