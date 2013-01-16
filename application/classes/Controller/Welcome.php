<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller_Base {

	public function action_index()
	{
		$this->template->content = View::factory('pages/welcome');
	}

} // End Welcome
