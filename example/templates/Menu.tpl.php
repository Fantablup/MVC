<?php
	$class="primaryBtn";
	$action = $_GET['action'] ?? "start";
?>
<div id="mainMenu">
	<div class="titleHeader"><?php echo $title; ?></div>
	<div>
		<ul>
			<li class="<?php if ($action === 'start') echo "menuSelected"; ?>"><a  href="?action=start">Start</a></li>
			<li class="<?php if ($action === 'addbox') echo "menuSelected"; ?>"><a href="?action=addbox">Add box</a></li>
			<li class="<?php if ($action === 'tableview') echo "menuSelected"; ?>"><a href="?action=tableview">Table</a></li>
			<li class="<?php if ($action === 'startinfo') echo "menuSelected"; ?>"><a href="?action=startinfo">Start Info</a></li>
		</ul>
	</div>
</div>
