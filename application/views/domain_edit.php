<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<tbody>
							<tr>
								<td width="30%">Domain Name </td>
								<td>: <?php echo $domain->name ?></td>
							</tr>
							<tr>
								<td>Domain ID</td>
								<td>: <?php echo $domain->id ?></td>
							</tr>
							<tr>
								<td>Domain Master</td>
								<td>: <?php echo $domain->master ?></td>
							</tr>
							<tr>
								<td>Last Check</td>
								<td>: <?php echo $domain->last_check ?></td>
							</tr>
							<tr>
								<td>Domain Type</td>
								<td>: <?php echo $domain->type ?></td>
							</tr>

							<tr>
								<td></td>
								<td><a class="btn btn-default" href="<?php echo base_url().'domains/records?_domain='.$domain->id ?>" role="button">Edit Records</a>
								<a class="btn btn-danger" data-toggle="modal" href='#modal-delete'>Delete Domain</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo base_url().'data_process/delete_domain' ?>" method="POST">
				<input type="hidden" name="id" value="<?php echo $domain->id ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Hapus Domain?</h4>
				</div>
				<div class="modal-body">
					Menghapus domain akan menghapus seluruh record yang terkain dengan domain tersebut.<br><strong>Apakah anda yakin?</strong>
					<p>
						<div class="checkbox">
							<label>
								<input type="checkbox" value="yes" name="konfirm" required>
								Lanjutkan
							</label>
						</div>
					</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
					<button type="submit" class="btn btn-danger">Lanjutkan</button>
				</div>
			</form>
		</div>
	</div>
</div>