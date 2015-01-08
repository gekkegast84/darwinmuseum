<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.1.min.js" ></script> 
<script type="text/javascript" src="http://www.kunalbabre.com/projects/table2CSV.js" ></script> 
<h2>Manager overzicht</h2><hr style='border:1px solid #a5a5a5;'/>

<b>totaal aantal bezoekers: <?= $count; ?></b><br/>
<b>Bezoekers vandaag: <?= $dayCount; ?></b><br/><br/>
<b>Bezoekers deze:</b>
<?= form_open('manager'); 
if(isset($_POST['time'])){
	$time = $_POST['time'];
}else{$time = 'day';}
?>
<select name='time' onchange="this.form.submit()">
	<option value='<?$time?>' selected><?= $time ?></otpion>
		<option value='month'>month</option>
		<option value='week'>week</option>
		<option value='day'>day</option>
	</select>
	<?= form_close(); ?>
	<table id='userTable' class='table table-striped'>
		<tr>
			<th>#:</th>
			<th>bezoeker:</th>
			<th>datum:</th>
			<th>barcode:</th>
		</tr>

		
		<?php foreach($getUser as $key => $val):
			$val2 = $getUserName[$key]; 
		?>
			<tr>
				<td><?= $val->id ?></td>
				<td><?= $val2[0]->name ?></td>
				<td><?= $val->dateoforder ?></td>
				<td><?= $val->barcode_id ?></td>
			</tr>

		<?php endforeach; ?>
	</table>
<button class='btn btn-info' onclick="$('#userTable').table2CSV();">excel format</button></a>