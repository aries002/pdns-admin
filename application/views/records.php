<?php

?>
<div class="row">
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<div class="panel panel-default">
			<div class="panel-body">
				<a class="btn btn-primary" data-toggle="modal" href='#tambah'>Tambah Baru</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10" align="auto">
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
										<option value="A" 		<?php if($tipe == 'A') echo "selected" ?>>A</option>
										<option value="AAAA" 	<?php if($tipe == 'AAAA') echo "selected" ?>>AAAA</option>
										<option value="CNAME" 	<?php if($tipe == 'CNAME') echo "selected" ?>>CNAME</option>
										<option value="MS" 		<?php if($tipe == 'MX') echo "selected" ?>>MX</option>
										<option value="NS" 		<?php if($tipe == 'NS') echo "selected" ?>>NS</option>
										<option value="PTR" 	<?php if($tipe == 'PTR') echo "selected" ?>>PTR</option>
										<option value="SOA" 	<?php if($tipe == 'SOA') echo "selected" ?>>SOA</option>
										<option value="SRV" 	<?php if($tipe == 'SRV') echo "selected" ?>>SRV</option>
										<option value="TXT" 	<?php if($tipe == 'TXT') echo "selected" ?>>TXT</option>
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
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php
				if ($records == null) {
				?>
			
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Record tidak ditemukan</strong>
				</div>
		
				<?php
				}
				else{
				?>
			
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?php echo $total ?> record ditemukan.</strong>
				</div>
				<?php 
				} 
				?>	
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="4%">id</th>
								<th>Name</th>
								<th width="6%">Type</th>
								<th>Content</th>
								<th width="8%">TTL</th>
								<th width="8%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($records as $key) {
								if ($key->disabled === '1') {
									echo '<tr class="danger">';
								}
								else{
									echo "<tr>";
								}
								echo "<td>$key->id. </td>";
								echo "<td>$key->name</td>";
								echo "<td>$key->type</td>";
								echo "<td>$key->content</td>";
								echo "<td>$key->ttl</td>";
								?>
								<td>
									<a class="btn btn-small  btn-block btn-default" data-toggle="modal" href='#modal<?php echo $key->id ?>'>
										<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
										  <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
										  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
										</svg>
									</a>
								</td>
							<?php
								echo "</tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<nav aria-label="Page navigation">
	                    <?php echo $this->pagination->create_links(); ?>
	            </nav>
	        </div>
		</div>
	</div>
</div>


<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<form method="post" action="<?php echo base_url('data_process/add_record?link='.$url2)?>">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Record</h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
							<tbody>
								<tr>
									<td>Domain :</td>
									<td>
										<select name="domain" id="input" class="form-control" required="required">
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
									</td>
								</tr>
								<tr>
									<td>Name :</td>
									<td><input type="text" name="name" id="inputName" class="form-control" required="required"  title=""></td>
								</tr>
								<tr>
									<td>Content :</td>
									<td><input type="text" name="content" id="inputName" class="form-control" required="required"  title=""></td>
								</tr>
								<tr>
									<td>Type :</td>
									<td>
										<select name="type" id="input" class="form-control" required="required">
											<option value="A" >A</option>
											<option value="AAAA" >AAAA</option>
											<option value="CNAME" >CNAME</option>
											<option value="MX" >MX</option>
											<option value="NS" >NS</option>
											<option value="PTR" >PTR</option>
											<option value="SOA" >SOA</option>
											<option value="SRV">SRV</option>
											<option value="TXT" >TXT</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>TTL :</td>
									<td><input type="text" name="ttl" id="inputName" class="form-control" required="required" value="3600" title=""></td>
								</tr>
								<tr>
									<td>Prio :</td>
									<td><input type="text" name="prio" id="inputName" class="form-control" required="required" value="0" title=""></td>
								</tr>
							
							</tbody>
						</table>

			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</form>
	</div>
</div>