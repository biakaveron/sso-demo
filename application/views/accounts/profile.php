<?php defined('SYSPATH') OR die('No direct access allowed.');?>
<h2><?php echo $_user->service_name ?></h2>
<ul>
	<? if ($avatar = $_user->get_avatar()) { echo HTML::image($avatar); } ?>
	<li>email: <?php echo $_user->email ?></li>
	<li>provider: <?php echo $_user->service_type ?></li>

</ul>
<a href="/logout">Выйти</a>