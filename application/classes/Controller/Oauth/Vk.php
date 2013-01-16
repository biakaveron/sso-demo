<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_OAuth_Vk extends Controller_OAuth2 {
	/**
	 * @var  OAuth2_Provider_Vk
	 */
	protected $_provider;

	public $name = 'Vk';
}
