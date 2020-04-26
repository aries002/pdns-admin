<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<form action="<?php echo base_url().'data_process/add_domain' ?>" method="POST" role="form" class="form-inline">
							<legend>Buat Domain</legend>
							<table class="table table-hover">
								<tbody>
									<tr>
										<td><label for="">Nama Domain</label></td>
										<td><input type="text" class="form-control" id="" name="domain" placeholder="Domain"></td>
									</tr>
									<tr>
										<td><label for="">Alamat Domain Default</label></td>
										<td><input type="text" class="form-control" id="" name="ip" placeholder="Alamat Ip utama domain"></td>
									</tr>
									<tr>
										<td><label for="">Alamat Name Server 1</label></td>
										<td><input type="text" class="form-control" id="" name="ip-ns1" placeholder="Alamat IP DNS 1"></td>
									</tr>
									<tr>
										<td><label for="">Alamat Name Server 2</label></td>
										<td><input type="text" class="form-control" id="" name="ip-ns2" placeholder="Alamat IP DNS 2"></td>
									</tr>
									<tr>
										<td><button type="submit" class="btn btn-primary">Submit</button></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
