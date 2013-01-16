<form action="<?=$options['uri'] ?>" method="POST" class="openid-identifier">
	<p>
		<input type="text" name="openid_identifier" placeholder="<?=__($options['id']) ?>" />
		<input type="submit" class="btn" value="<?=__("login") ?>" />
	</p>
</form>