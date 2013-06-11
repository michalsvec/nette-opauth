<?php


namespace Elemedia\Opauth;


interface IOpauthIdentity 
{
	public function getName();

	public function getImage();

	public function getProfileUrl();

	public function getProvider();
}