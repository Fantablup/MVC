<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<script type="text/javascript" src="js/scripts.js"></script>  
		<meta charset="UTF-8">
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<div class="waitBox modalBox defaultBox">
			<div class="modalHeader">Please wait...</div>
			<div class="modalContext">
			<div class="modalText"></div>
			
			</div>
			<div class="modalButtons"></div>
		</div>
		<div id="mainContainer">
			<img class="infoImage" src="images/info.png"/>
			<?php echo $menu; ?>
			<div id="mainBody">
				<a class="homeLink" href="https://eunore.com/">euNore.com</a>
				<?php if (isset($content)) echo $content; ?>
			</div>
			<div id="mainFooter">Created By Viggo Jamne</div>
		</div>
	</body>
</html>