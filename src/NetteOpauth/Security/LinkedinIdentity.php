<?php

namespace NetteOpauth\Security;

/**
 * Wrapper for data returned from LinkedIn oauth provider
 *
 * @author Lukas Vana <fabian@fabian.cz>
 */
class LinkedinIdentity extends BaseIdentity implements IOpauthIdentity 
{
	/**
	 * {@inheritdoc}
	 */
	public function getProvider()
	{
		return "Linkedin";
	}
}