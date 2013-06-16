<?php

namespace NetteOpauth\Security;

/**
 * Wrapper for data returned from twitter oauth server
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class TwitterIdentity extends BaseIdentity implements IOpauthIdentity 
{
	/**
	 * {@inheritdoc}
	 */
	public function getProvider()
	{
		return "Twitter";
	}

	/**
	 * {@inheritdoc}
	 */
	public function getProfileUrl()
	{
		return $this->date["link"]['twitter'];
	}
}