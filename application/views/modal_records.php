<div class="modal fade" id="<?php echo $id ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo base_url('domains/edit_record?link='.$url2) ?>" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Edit <?php echo $name; ?></h4>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-hover">
							<tbody>
								<input type="hidden" name="id" value="<?php echo $data->id ?>">
								<tr>
									<td>Name :</td>
									<td><input type="text" name="name" id="inputName" class="form-control" value="<?php echo $data->name ?>" required="required"  title=""></td>
								</tr>
								<tr>
									<td>Content :</td>
									<td><input type="text" name="content" id="inputName" class="form-control" value="<?php echo $data->content ?>" required="required"  title=""></td>
								</tr>
								<tr>
									<td>Type :</td>
									<td>
										<select name="type" id="input" class="form-control" required="required">
											<option <?php if($data->type == 'A') echo "selected" ?>>A</option>
											<option <?php if($data->type == 'AAAA') echo "selected" ?>>AAAA</option>
											<option <?php if($data->type == 'CNAME') echo "selected" ?>>CNAME</option>
											<option <?php if($data->type == 'MX') echo "selected" ?>>MX</option>
											<option <?php if($data->type == 'NS') echo "selected" ?>>NS</option>
											<option <?php if($data->type == 'PTR') echo "selected" ?>>PTR</option>
											<option <?php if($data->type == 'SOA') echo "selected" ?>>SOA</option>
											<option <?php if($data->type == 'SRV') echo "selected" ?>>SRV</option>
											<option <?php if($data->type == 'TXT') echo "selected" ?>>TXT</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>TTL :</td>
									<td><input type="text" name="ttl" id="inputName" class="form-control" value="<?php echo $data->ttl ?>" required="required"  title=""></td>
								</tr>
								<tr>
									<td>Prio :</td>
									<td><input type="text" name="prio" id="inputName" class="form-control" value="<?php echo $data->prio ?>" required="required"  title=""></td>
								</tr>
							
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-danger" href="<?php echo base_url().'domains/delete_record/'.$data->id.'?link='.$url2 ?>" role="button">Delete</a>
					<a class="btn btn-info" href="<?php echo base_url().'domains/dissable_record/'.$data->id.'?link='.$url2 ?>" role="button">
						<?php if ($data->disabled === '1') {
							echo 'Enable';
						}
						else{
							echo 'Disable';
						} ?>
					</a>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


