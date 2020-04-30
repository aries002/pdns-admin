<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<a class="btn btn-success" href="<?php echo base_url().'domains/tambah' ?>" role="button">Tambah</a>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th width="5%">ID</th>
								<th>Domain</th>
								<th width="10%">Tipe</th>
								<th width="10%"></th>
								<th width="5%"></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($db_domain as $key) {
							?>
							<tr>
								<td><?php echo $key->id ?></td>
								<td><?php echo $key->name ?></td>
								<td><?php echo $key->type ?></td>
								<td>
									<a class="btn btn-small btn-block btn-default" href="<?php echo base_url().'domains/records?_domain='.$key->id ?>"> Records</a>
								</td>
								<td>
									<a class="btn btn-small  btn-block btn-default" href='<?php echo base_url()."domains/edit/$key->id"?>'>
										<svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor">
										  <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
										  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
										</svg>
									</a>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>