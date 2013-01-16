<!DOCTYPE html>
<html>
<head>
	<title><?=$title ?></title>
	<link href="/media/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="/media/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="/media/css/layout.css" rel="stylesheet">
	<? foreach($_css as $css) { echo html::style($css) . PHP_EOL; } ?>
</head>
<body>
	<div id="wrap">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <!--<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>-->
                    <div class="nav-collapse collapse navbar-responsive-collapse">
                        <ul class="nav">
                            <li class="active"><a href="/">SSO Demo App</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <?=$userblock ?>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div>
            </div><!-- /navbar-inner -->
        </div>
		<div id="content" class="container clear-top">
            <div id="message-container">
				<? foreach($_errors as $error) { ?>
	            <div class="alert alert-error"><?=$error ?></div>
                <? } ?>
	            <? foreach($_success as $success) { ?>
                <div class="alert alert-success"><?=$success ?></div>
	            <? } ?>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <?=$content ?>
				</div>
            </div>
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="/media/js/bootstrap.min.js"></script>
	<? foreach($_js as $js) { echo html::script($js) . PHP_EOL; } ?>
	<div id="footer">123</div>
<? //DebugToolbar::render(); ?>
</body>
</html>