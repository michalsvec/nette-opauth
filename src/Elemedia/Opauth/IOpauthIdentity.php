<?php

namespace Elemedia\Opauth;

/**
 * Basic interface common for all oauth providers
 *
 * @author Michal Svec <pan.svec@gmail.com>
 */
interface IOpauthIdentity 
{
	/**
	 * Get full name
	 *
	 * @return string
	 */
	public function getName();

	/**
	 * Get avatar image link
	 *
	 * @return string
	 */
	public function getImage();

	/**
	 * Get provider profile URL
	 *
	 * @return string
	 */
	public function getProfileUrl();

	/**
	 * Get provider name
	 *
	 * @return string
	 */
	public function getProvider();
}