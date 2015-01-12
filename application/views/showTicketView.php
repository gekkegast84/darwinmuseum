<!DOCTYPE html>
<html>
<head>
	<title>Ticket</title>
		<style type="text/css">

	h2,hr,p{
		margin, padding: 0px;
	}

	.left, .right{
		float:left;
		padding:1%;
		width: 48%;
	}

	.title{
		float:left;
		padding:1%;
		width: 68%;
	}

	.barcode{
		float:left;
		padding:1%;
		width: 28%;
	}
	.clear{
		clear:both;
	}

	.barcode{
		float: right;
	}

	</style>
</head>
<body>
<div class='title'><h2>DARWIN MUSEUM TICKET</h2></div>
<div class='barcode'><barcode code="<?php echo $barcodeID;?>" type="ISBN" height="0.66" text="1"></barcode></div>
<div class='clear'></div>
<hr style='border:1px solid #a5a5a5;'/>
<div class='left'>
	<p><?php echo $price[1]; ?><br/>
	naam: <?php echo''.$ticket[0].' '.$ticket[1].' '.$ticket[2].''; ?><br/>
	prijs: <?php echo'&euro;&nbsp;'.$price[2].',-'; ?></p><br/>
	<small>Nicolaaskerkhof 10, 3500 GC  Utrecht<br/> 
	+31(0)30-2362362 <Br/>www.darwinmuseum.nl</small>
</div>
<div class='right'>
	<img alt="artifact a day" src='<?= base_url('artifact/artifact_'.$imgDay.'.jpg');?>'/>
</div>
</body>
</html>
