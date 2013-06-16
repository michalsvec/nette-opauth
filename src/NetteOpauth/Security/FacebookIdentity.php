<?php

namespace NetteOpauth\Security;

/**
 * Wrapper for data returned from facebook oauth provider
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class FacebookIdentity extends BaseIdentity
{
	/**
	 * {@inheritdoc}
	 */
	public function getProvider()
	{
		return "Facebook";
	}
}