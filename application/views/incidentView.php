<div class='row'>
	<div class='col-md-8'>
		<h2>Incident</h2><hr style='border:1px solid #a5a5a5;'/>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>betrokkenen:</th>          
					<th>gemeld door:</th>
					<th>datum:</th>
					<th>categorie:</th>
					<th>Omschrijving:</th>
					<th>status:</th>
				</tr>
			</thead>
			<tbody>
			<?php	
			 foreach ($incidents as $key => $incident):
				echo "<tr>";
				echo "<td>".$incident->id."</td>";
				echo "<td>";
				$j = count($user);
				for ($i=0; $i < $j; $i++) { 
					echo $user[$i]->firstname." ";
				}
				echo"</td>";
				echo "<td>".$incident->reported_by."</td>";
				echo "<td>".$incident->dateofemergency."</td>";
				echo "<td>".$incident->category."</td>";
				echo "<td>".$incident->emergency_description."</td>";
				echo "<td>".$incident->status."</td>";
				echo "</tr>";
				endforeach; ?>
			</tr>
		</tbody>
	</table>		
</div>
<div class='col-md-4'>
	<h2>rapporteren</h2><hr style='border:1px solid #a5a5a5;'/>
	<?= form_open('incident/reportIncident'); ?>
	<div class="form-group">
		<label for="reported_by">gemeld door:</label>
		<input type="text" value="<?= $getCurrentUser['username'] ?>" class="form-control" name="reported_by" readonly />
	</div>
	<div class="form-group">	
		<label for="reported_by">betrokkenen:</label>
		<select name='involved[]' class="form-control" size="3" multiple="multiple" tabindex="1">
			<?php foreach($allUsers as $involve): ?>
				<option value="<?= $involve->id ?>"><?= $involve->firstname ."&nbsp;". $involve->prefix . "&nbsp;" . $involve->lastname ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class='form-group'>
		<label for="date">datum:</label>
		<input type='date' class='form-control' name='date'/>
	</div>
	<div class='form-group'>
		<label for="status">status:</label>
		<input type='text' class='form-control' name='status' value="lopend" disabled />
	</div>
	<div class='form-group'>
	<label for="category">categorie:</label>
		<select name='category' class='form-control'>
			<option value='schade'>schade</option>
			<option value='geweld'>geweld</option>
			<option value='vandalisme'>vandalisme</option>
		</select>
	</div>
	<div class='form-group'>
		<label for="description">omschrijving:</label>
		<textarea name="description" class='form-control' rows='4' style='resize: vertical;'></textarea>
	</div>
	<button type="submit" class="btn btn-primary">rapporteren</button>
	<?= form_close(); ?>
</div>
</div>