<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Base extends Controller_Template {

	/**
	 * @var  View
	 */
	public $template = 'layout/template';

	/**
	 * @var SSO
	 */
	protected $_sso;

	/**
	 * @var Model_Auth_Data
	 */
	protected $_user;

	/**
	 * @var Session
	 */
	protected $_session;

	protected $_styles = array();
	protected $_scripts = array();

	/**
	 * Is the request is Ajax-like
	 *
	 * @var boolean
	 */
	protected $_ajax = FALSE;

	protected function _changed_uri($params)
	{
		if (is_string($params))
		{
			// assume its an action name
			$params = array('action' => $params);
		}

		$current_params = $this->request->param();
		$current_params['controller'] = strtolower($this->request->controller());
		$current_params['directory'] = strtolower($this->request->directory());
		$current_params['action'] = strtolower($this->request->action());
		$params = $params + $current_params;
		return Route::url(Route::name(Request::current()->route()), $params, TRUE);
	}


	/**
	 * @param string  $event
	 * @param string  $default_uri
	 *
	 * @throws HTTP_Exception_301
	 */
	protected function _go_back($event, $default_uri = '')
	{
		$uri = $this->_session->get_once($event, $default_uri);
		HTTP::redirect($uri);
	}

	protected function _save_referer($event, $referer = FALSE)
	{
		if ($referer === TRUE)
		{
			$referer = $this->request->uri();
		}
		elseif ($referer === FALSE)
		{
			$referer = Request::initial()->referrer();
		}
		else
		{
			$referer = (string) $referer;
		}

		$hostname = parse_url($referer, PHP_URL_HOST);
		$current_hostname = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
		if ($hostname == $current_hostname)
		{
			$this->_session->set($event, $referer);
			return TRUE;
		}

		return FALSE;
	}

	protected function _error($text = NULL, $params = NULL)
	{
		if ($text === NULL)
		{
			return $this->_session->get_once('messages.errors', array());
		}

		$errors = & $this->_session->as_array();
		$errors['messages.errors'][] = __($text, $params);
		return $this;
	}

	protected function _success($text = NULL, $params = NULL)
	{
		if ($text === NULL)
		{
			return $this->_session->get_once('messages.success', array());
		}

		$messages = & $this->_session->as_array();
		$messages['messages.success'][] = __($text, $params);
		return $this;
	}

	protected function _css($style = NULL)
	{
		if ($style === NULL)
		{
			return $this->_styles;
		}

		if (strpos('://', $style) === FALSE)
		{
			$style = 'media/' . ltrim($style, '/');
		}

		$this->_styles[$style] = $style;
		return $this;
	}

	protected function _js($script = NULL)
	{
		if ($script === NULL)
		{
			return $this->_scripts;
		}

		if (strpos('://', $script) === FALSE)
		{
			$script = 'media/' . ltrim($script, '/');
		}
		$this->_scripts[$script] = $script;
		return $this;
	}

	public function before()
	{
		parent::before();

		$this->_session = Session::instance();

		// Ajax-like request check
		if ($this->request->is_ajax() OR ! $this->request->is_initial() )
		{
			$this->_ajax = TRUE;
		}

		$this->_sso = SSO::instance();
		$this->_user = $this->_sso->get_user();

		if ($this->auto_render)
		{
			// default template variables  initialization
			$this->template->title    = ''; // page title
			//$this->template->content  = ''; // page content
			$this->template->sidebar  = ''; // page sidebar
			$this->template->bind_global('_user', $this->_user);
			$this->template->set('_errors', $this->_error())->set('_success', $this->_success());
			$this->template->content = View::factory('pages/content');
			$userblock = View::factory('accounts/userblock/'. ($this->_user ? 'user' : 'guest'));

			$this->template->userblock = $userblock;

		}
	}

	public function after()
	{
		// Using template content on Ajax-like requests
		if ($this->_ajax === TRUE)
		{
			$this->response->body($this->template->content);
		}
		else
		{
			$this->template->set('_css', $this->_css())->set('_js', $this->_js());
			parent::after();
		}
	}

	public function action_index() {
		$this->template->content = View::factory('pages/welcome');
	}
}