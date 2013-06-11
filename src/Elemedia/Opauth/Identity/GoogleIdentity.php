<?php


namespace Elemedia\Opauth;

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