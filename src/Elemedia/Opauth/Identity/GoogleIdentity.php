<?php

namespace Elemedia\Opauth;

/**
 * Wrapper for data returned from google oauth server
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
class GoogleIdentity extends BaseIdentity implements IOpauthIdentity 
{
	public function getProvider()
	{
		return "Google";
	}

	public function getName()
	{
		return $this->data['name'];
	}

	public function getImage()
	{
		return $this->data["image"];
	}

	public function getProfileUrl()
	{
		return $this->data["link"];
	}
}