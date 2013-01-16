<?php defined('SYSPATH') OR die('No direct access allowed.');
$route = Route::get('accounts-auth');
$links = array(
	'openid'   => array(
		'openid'      => array(
			'title' => 'OpenID',
			'id'    => 'Enter full OpenID identifier',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'openid', 'action' => 'login')),
		),
		'wordpress'   => array(
			'title' => 'Wordpress',
			'id' => 'Enter your WP username',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'wordpress', 'action' => 'login')),
		),
		'yahoo'       => array(
			'title' => 'Yahoo!',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'yahoo', 'action' => 'login')),
		),
		'myopenid'    => array(
			'title' => 'MyOpenID',
			'id' => 'Enter your MyOpenID username',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'myopenid', 'action' => 'login')),
		),
		'google'      => array(
			'title' => 'Google',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'google', 'action' => 'login')),
		),
		'livejournal' => array(
			'title' => 'LiveJournal',
			'id' => 'Enter your LJ username',
			'uri'   => $route->uri(array('directory' => 'openid', 'controller' => 'livejournal', 'action' => 'login')),
		),
	),
	'oauth'    => array(
		'google'      => 'Google',
		'twitter'     => 'Twitter',
		'github'      => 'Github',
		'facebook'    => 'Facebook',
		'linkedin'    => 'LinkedIn',
		'vk'          => 'VKontakte',
		'yandex'      => 'Yandex',
		'yahoo'       => 'Yahoo',
	),
);
?>
<h2><?php echo __("Select provider")?></h2>
	<div id="login-tabs">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#openid">OpenID</a></li>
			<li><a href="#oauth">OAuth</a></li>
		</ul>
		<div class="tab-content">
			<div id="openid" class="tab-pane active">
                <h3><?=__("List of supported OpenID providers")?></h3>
				<?php $params = array('directory' => 'openid'); ?>
				<ul class="login-providers accordion">
					<?php foreach($links['openid'] as $provider => $options) :?>
						<li class="well">
							<?php echo html::anchor($options['uri'], $options['title'], array('class' => (isset($options['id']) ? 'openid-required ' : '').'social-icon '.$provider))?>
							<? if (isset($options['id'])) { echo View::factory('accounts/openid/_identity', array('provider' => $provider, 'options' => $options)); } ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<div id="oauth" class="tab-pane">
                <h3><?=__("List of supported OAuth providers")?></h3>
				<ul class="login-providers">
					<?php foreach($links['oauth'] as $provider => $ptitle) :?>
						<li class="well"><?php echo html::anchor($route->uri(array('directory' => 'oauth', 'controller' => $provider, 'action' => 'login')), $ptitle, array('class' => 'social-icon '.$provider))?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
