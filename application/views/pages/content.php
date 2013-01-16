<div class="span3">
    <div class="well sidebar-nav">
        <ul class="nav nav-list">
            <li class="nav-header">Calendar</li>
	        <li class="active"><a href="<?=Core::uri('default')?>">View</a></li>
	        <li><a href="<?=Core::uri('default', 'import')?>">Import</a></li>
	        <li><a href="<?=Core::uri('default', 'export')?>">Export</a></li>
	        <li><a href="<?=Core::uri('default', 'delete')?>">Reset</a></li>
            <li class="nav-header">Sidebar</li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li class="nav-header">Sidebar</li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
            <li><a href="#">Link</a></li>
        </ul>
    </div><!--/.well -->
</div><!--/span-->
<div class="span9">

	<?=$content ?>
</div>