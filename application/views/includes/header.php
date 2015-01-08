<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Darwin Museum</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	
	<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?= BASE_URL(); ?>public/css/style.css">
	<link rel="shortcut icon" href="http://www.gemeentemuseum.nl/sites/all/themes/gemeentemuseum/favicon.ico" type="image/vnd.microsoft.icon">
</head>
<body>
	<?php $login = $this->session->userdata('logged_in'); ?>
	<div class='container'>
		<header>
			<nav class="">
				<ul class='menuLeft'>
					<a href="<?= BASE_URL(); ?>"><img class='logo' src='<?= BASE_URL(); ?>public/img/logo.png' alt='logo gemeentemuseum den haag'></a>					
				</ul>
				<br/>
				<ul class='menuRight'>
				<small class='adres'>Stadhouderslaan 41 | 2517 HV | Den Haag</small>
					<?php if($login): ?>
						<?php if($login['roles'] == "1"): ?>
							<li><a href="<?= BASE_URL(); ?>collection">Collectie</a></li>
							<li><a href="<?= BASE_URL(); ?>badLogins">foute logins</a></li>
							<li><a href="<?= BASE_URL(); ?>home/logout">Logout</a></li>
						<?php elseif($login['roles'] == "6"): ?>
							<li><a href="<?= BASE_URL(); ?>manager">Home</a></li>
							<li><a href="<?= BASE_URL(); ?>home/logout">Logout</a></li>
						<?php elseif($login['roles'] == "9"): ?>
							<li><a href="<?= BASE_URL(); ?>ticket">Verkopen</a></li>
							<li><a href="<?= BASE_URL(); ?>incident">incident</a></li>
							<li><a href="<?= BASE_URL(); ?>home/logout">Logout</a></li>
						<?php endif; ?>
					<?php else: ?>
						<li><a href="<?= BASE_URL(); ?>home">Home</a></li>
						<li><a href="<?= BASE_URL(); ?>collection">Collectie</a></li>
						<li><a href="<?= BASE_URL(); ?>contact">Contact</a></li>
				</ul>
				<?php endif; ?>
		</nav>
		<div class="clear"></div>
		<?php if (!$login || $login['roles'] == "9"): ?>
			<p class='ticketbar'><a href="<?php echo BASE_URL(); ?>ticket" id="buyticket">Koop Tickets</a></p>
		<?php endif; ?>
	</header>
	<div class="clear"></div>
	<?php 
	if($this->session->flashdata('flashSuccess')){
		echo"<div class='alert alert-success' role='alert'><i class='fa fa-check'>&nbsp;</i>". $this->session->flashdata('flashSuccess') ."</div>";
	}
	if($this->session->flashdata('flashWarning')){
		echo"<div class='alert alert-warning' role='alert'>". $this->session->flashdata('flashWarning') ."</div>";
	}
	?>