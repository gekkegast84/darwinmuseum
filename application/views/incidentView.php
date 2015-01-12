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
			//var_dump($involved);
			foreach ($incidents as $key => $incident):
				$id = $incident->id;

				echo "<tr>";
				echo "<td>".$id."</td>";
				echo "<td>";
					$ids = $id - 1;
					$count = count($involved[$ids]);
					for($i=0; $i < $count; $i++): 
						echo $involved[$ids][$i]->firstname."&nbsp;".$involved[$ids][$i]->prefix."&nbsp;".$involved[$ids][$i]->lastname."<br/>";
					endfor;
				echo "</td>";
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
		<input type="text" value="<?= $this->session->userdata['logged_in']['username'] ?>" class="form-control" name="reported_by" readonly />
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