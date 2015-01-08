<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src='<?= BASE_URL(); ?>public/js/jquery.battatech.excelexport.js'></script>
<script type="text/javascript" src='<?= BASE_URL(); ?>public/js/jquery.battatech.excelexport.min.js'></script>

<div class='row'>
<!-- 	<div class='col-md-8'>
		<h2>bad logins</h2>
		<hr style="border:1px solid #a5a5a5;"> -->
<div class="col-md-8">
    <table id="tblExport" class="table table-bordered">
    	<thead>
				<tr>
					<th>#</th>
					<th>email:</th>
					<th>wachtwoord:</th>
					<th>aantal logs:</th>
					<th>geblokkeerd geweest:</th>
				</tr>
			<thead>
			<tbody>
				<?php foreach ($all as $value): ?>
				<tr>
					<td><?= $value->id ?></td>
					<td><?= $value->email ?></td>
					<td><?= $value->password ?></td>
					<td><?= $value->count ?></td>
					<td><?php if ($value->wasblocked == 0){
						echo "nee";
						}else{echo "ja";} ?>
					</td>
				</tr>
				<?php endforeach; ?>
				</body>
			</table>
			<button id="btnExport" class='btn btn-info'>csv format</button>
		</div>
	<div class='col-md-4'>
		<h2>geblokeerd</h2>
		<hr style="border:1px solid #a5a5a5;">
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>email:</th>
				<th>wachtwoord:</th>
				<th>aantal logs:</th>
				<th></th>
			</tr>
			<?php foreach ($blocked as $block): ?>
			<tr>
				<td><?= $block->id ?></td>
				<td><?= $block->email ?></td>
				<td><?= $block->password ?></td>
				<td><?= $block->count ?></td>
				<td><a id='unblock' href='<?= BASE_URL(); ?>badLogins/unblock/<?= $block->id ?>'><button class='btn btn-primary'><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button></a></td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
        $("#btnExport").click(function () {
            $("#tblExport").btechco_excelexport({
                containerid: "tblExport"
               , datatype: $datatype.Table
            });
        });
    });
</script>