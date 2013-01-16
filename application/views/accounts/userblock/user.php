<?
$actions = array(
	'/logout'  => __('Logout'),
	'/profile' => __('Profile'),
);
?>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_user->service_name ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
		<? foreach($actions as $uri => $title) { ?>
        <li><a href="<?=$uri?>"><?=$title ?></a></li>
		<? } ?>
    </ul>
</li>