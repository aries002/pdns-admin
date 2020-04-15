<?php

?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" align="auto">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<form action="<?php echo $url ?>" class="form-inline" role="form">
									<label for="domain">
										Domain : 
									</label>
									<select class="form-control" id="domain" name="_domain" onchange="location = '<?php echo $url ?>?_domain='+this.value;">
										<option <?php if ($domain == '') echo 'selected' ?> disabled> -- Pilih Domain -- </option>
										<?php
										foreach ($domain_list as $key1) {
											if ($domain == $key1->id) {
												$select = 'selected';
											}
											else{
												$select = '';
											}
											echo '<option '.$select.' value="'.$key1->id.'">'.$key1->name.'</option>';
										}
										?>
									</select>
									<label for="tipe">
										Tipe : 
									</label>
									<select class="form-control" id="tipe" name="tipe">
										<option <?php if($tipe == null) echo 'selected' ?> value=''>Semua</option>
										<option <?php if($tipe == 'A') echo "selected" ?>>A</option>
										<option <?php if($tipe == 'AAAA') echo "selected" ?>>AAAA</option>
										<option <?php if($tipe == 'CNAME') echo "selected" ?>>CNAME</option>
										<option <?php if($tipe == 'MX') echo "selected" ?>>MX</option>
										<option <?php if($tipe == 'NS') echo "selected" ?>>NS</option>
										<option <?php if($tipe == 'PTR') echo "selected" ?>>PTR</option>
										<option <?php if($tipe == 'SOA') echo "selected" ?>>SOA</option>
										<option <?php if($tipe == 'SRV') echo "selected" ?>>SRV</option>
										<option <?php if($tipe == 'TXT') echo "selected" ?>>TXT</option>
									</select>
									<label for="cari">Name : </label>
									<input type="search" name="cari" id="cari" class="form-control" value="" title="">
									<label for="cari2">Content : </label>
									<input type="search" name="cari2" id="cari2" class="form-control" value="" title="">
									<button type="submit" class="btn btn-primary" value="cari" name="submit">Cari</button>
								</form>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<?php
		if ($records == null) {
			?>
		<div class="row">
			<div class="alert alert-warning">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Record tidak ditemukan</strong>
			</div>
		</div>
			<?php
		}
		else{
		?>
		<div class="row">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $total ?> record ditemukan.</strong>
			</div>
		</div>
	<?php } ?>
		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th width="4%">No</th>
							<th>Name</th>
							<th width="6%">Type</th>
							<th>Content</th>
							<th width="8%">TTL</th>
						</tr>
					</thead>
					<tbody>
						<?php
						//var_dump($records);

						$no = 1;
						foreach ($records as $key) {
							echo "<tr>";
							echo "<td>$key->id. </td>";
							echo "<td>$key->name</td>";
							echo "<td>$key->type</td>";
							echo "<td>$key->content</td>";
							echo "<td>$key->ttl</td>";
							echo "</tr>";
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<nav aria-label="Page navigation">
                    <?php echo $this->pagination->create_links(); ?>
            </nav>
		</div>
	</div>
</div>
