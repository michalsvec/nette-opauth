<?php


namespace Elemedia\Opauth;

class TwitterIdentity extends BaseIdentity implements IOpauthIdentity 
{
	public function getProvider()
	{
		return "Twitter";
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
		return $this->date["link"]['twitter'];
	}
}