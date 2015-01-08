<div class="row">
	<div class="col-md-8">
		<h2>Collectie</h2><hr style='border:1px solid #a5a5a5;'/>
	</div>
		<div class="col-md-4">
		<?php	
			if($this->session->userdata('logged_in')):
				if($this->session->userdata['logged_in']['roles'] == '1' ): ?>
			<?= form_open_multipart('collection/doUpload'); ?>
			<div class="form-group">
				<h2 for="exampleInputFile">Bestand uploaden</h2><hr style='border:1px solid #a5a5a5;'/>
				<input type="file" name="userfile" size="20"  id="exampleInputFile">
				<p class="help-block">gif | jpg | png</p>
			</div>
			<button type="submit" class="btn btn-primary">upload</button>
		</form>
		<?php
		endif;
		endif;
		?>
	</div>
	<div class='col-md-12'>
	<?php
	$i = 0;
	$j = count($images);
	foreach($images as $img): 
	$i++;
			if($this->session->userdata('logged_in')):
				if($this->session->userdata['logged_in']['roles'] == '1' ): ?>					
					<form action="<?= BASE_URL(); ?>collection/deleteImage"method="post">
						<input type="hidden" value="<?=$img?>" name="delete_file" />
						<button type="submit" onclick="return confirm('weet je het zeker dat je deze afbeelding wilt verwijderen?') "class="btn btn-danger margin"><span class="glyphicon glyphicon-trash"></span></button>
					</form>
						<?php
						endif;
					endif;

	?>
		<img src="<?= BASE_URL(); ?><?= $img ?>" class='responseitem'>
		<?php
					if($i % 2 == 0 && $i < $j) {echo '</div><div class="col-md-12">';}
	endforeach; ?>
	</div>
</div>