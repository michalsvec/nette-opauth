<?php

namespace NetteOpauth\Security;

/**
 * Wrapper for data returned from google oauth provider
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class GoogleIdentity extends BaseIdentity implements IOpauthIdentity 
{
	/**
	 * {@inheritdoc}
	 */
	public function getProvider()
	{
		return "Google";
	}
}