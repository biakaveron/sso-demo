<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Auth extends Controller_Base {

	protected $_data_key    = 'Auth_data';

	/**
	 * Show list of providers
	 */
	public function action_login()
	{
		$this->template->title = __('Select your provider');
		$this->template->content = View::factory('accounts/login');
		$this->_css('css/accounts/login.css');
		$this->_js('js/accounts/login.js');
		//StaticCss::instance()->add_modpath('css/accounts/login.css');
		//StaticJs::instance()->add_modpath('js/accounts/login.js');
		// куда отредиректить после авторизации
		$this->_save_referer('account/login', $this->_changed_uri('complete'));
		// запоминаем, откуда пришел пользователь
		$this->_save_referer('auth/login');
	}

	public function action_complete()
	{
		$auth_data = $this->_sso->get_user();

		if (empty($auth_data) || $auth_data->loaded() == FALSE)
		{
			$this->_error('Authentication failed');
		}
		else
		{
			$this->_success('Welcome, :user', array(':user' => $auth_data->service_name));
		}

		$this->_go_back('auth/login');
	}

	/**
	 * Log out and redirect back
	 *
	 * @throws HTTP_Exception_301
	 * @return void
	 */
	public function action_logout()
	{
		if ($this->_user)
		{
			$this->_sso->logout();
			$this->_success('You have successfully logged out');
		}

		HTTP::redirect(URL::base());
	}


	public function action_profile()
	{
		if ( ! $this->_user)
		{
			$this->_error('You must be logged in');
			// redirect to login page
			HTTP::redirect($this->_changed_uri('login'));
		}

		$this->template->content = View::factory('accounts/profile');
	}

	public function action_loginboard()
	{
		if ( ! $this->_ajax)
		{
			throw new HTTP_Exception_404();
		}

		if ($this->_user)
		{
			$provider = explode('.', $this->_sso->get_user()->service_name);
			$this->template->container->content = View::factory('accounts/user')
				->set('provider', end($provider));
		}
		else
		{
			$this->template->container->content = View::factory('accounts/guest');
		}
	}

}