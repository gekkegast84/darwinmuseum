<?php
if($this->session->userdata('logged_in')):
	if($this->session->userdata['logged_in']['roles'] == '9' ): ?>
<form action="<?= BASE_URL(); ?>ticket/payTicket" method="POST">
	<div class="row">
		<div class="col-md-8">
			<h2>Welkom verkoper</h2><hr style='border:1px solid #a5a5a5;'/>
			<p>Om een ticket te verkopen willen we graag de volgende informatie van de klant weten:</p>
			<div class="col-md-4">
				<div class="form-group">
					<label for="voornaam">Voornaam: *</label>
					<input type="text" class="form-control" name="firstname" id="voornaam" required>
				</div>
				<div class="form-group">
					<label for="prefix">Tussenvoegsel:</label>
					<input type="text" class="form-control" name="prefix" id="tussenvoegsel">
				</div>
				<div class="form-group">
					<label for="lastname">Achternaam: *</label>
					<input type="text" class="form-control" name="lastname" id="achternaam" required>
				</div>  	
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="dob">Geboortedatum: *</label>
					<input type="date" class="form-control" name="dob" id="gebdatum" required>
				</div>
			</div>
		</div>
	</div>
	<button type="submit" name='sendInfo' value='sendInfo' class="btn btn-default">Koop ticket</button>
</form>
<?php endif; ?>
<?php elseif (empty($this->session->userdata['logged_in'])): ?>
	<form action="<?= BASE_URL(); ?>ticket/payTicket" method="POST">
		<div class="row">
			<div class="col-md-8">
				<h2>Ticket kopen</h2><hr style='border:1px solid #a5a5a5;'/>
				<p>Om een ticket te kopen willen we graag de volgende informatie van u:</p>
				<div class="col-md-6">
					<div class="form-group">
						<label for="voornaam">Voornaam: *</label>
						<input type="text" class="form-control" name='firstname' id="voornaam" required>
					</div>
					<div class="form-group">
						<label for="prefix">Tussenvoegsel:</label>
						<input type="text" class="form-control" name='prefix' id="tussenvoegsel">
					</div>
					<div class="form-group">
						<label for="lastname">Achternaam: *</label>
						<input type="text" class="form-control" name='lastname' id="achternaam" required>
					</div>  	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="dob">Geboortedatum: *</label>
						<input type="date" class="form-control" name='dob' id="gebdatum" required>
					</div>
					<div class="form-group">
						<label for="zipcode">Postcode: *</label>
						<input type="text" class="form-control" name='zipcode' id="postcode" required>
					</div>
					<div class="form-group">
						<label for="residence">Woonplaats: *</label>
						<input type="text" class="form-control" name='residence' id="woonplaats" required>
					</div>  
				</div>
			</div>
		</div>
		<button type="submit" name='sendInfo' value='sendInfo' class="btn btn-default">Koop ticket</button>
	</form>
<?php endif; ?>