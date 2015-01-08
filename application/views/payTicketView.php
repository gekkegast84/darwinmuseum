<h2>U betaalt aan het Darwin Museum</h2><hr style='border:1px solid #a5a5a5;'/>
<div class="row">
	<div class="col-xs-6 col-md-4">
		<strong>Omschrijving: </strong><p>betaling <?= $priceInfo['1'] ?> kaartje</p><br/>
		<strong>Bedrag: </strong><p>&euro; <?= $priceInfo['2'] ?>,-</p><br/>
		<br/><br/>
		<form method="POST" action="<?php BASE_URL(); ?>ticket/displayTicket">
			Kies uw bank:
			<select name='bank' class="form-control">
				<option value='abn_amro'>ABN AMRO</option>
				<option value='ing'>ING</option>
				<option value='asn_bank'>ASN Bank</option>
				<option value='knab'>Knab</option>
				<option value='rabobank'>Rabobank</option>
				<option value='regiobank'>RegioBank</option>
				<option value='sns_bank'>SNS Bank</option>
				<option value='trodios_bank'>Triodos Bank</option>
				<option value='van_lanschot'>Van Lanschot</option>
			</select>
			<?php foreach($priceInfo as $infoPrice): ?>
				<input type="hidden" name="price[]" value="<?= $infoPrice ?>">
			<?php endforeach; ?>
			<?php foreach ($ticketInfo as $infoTicket): ?>
				<input type="hidden" name="ticket[]" value="<?= $infoTicket ?>">
			<?php endforeach; ?>
			<input type='submit' name='paid'>
		</form>
	</div>
	<div class="col-xs-6 col-md-4"></div>
	<div class="col-xs-6 col-md-4">
		<img src='https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTo3PODC1NDs49UfmqXyyQDyi7-eqPXifwBL2xCSrUQEW5wpjEYOfni0w' alt='ideal'>
	</div>
</div>
