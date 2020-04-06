<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" align="auto">
		<?php
		if ($records == null) {
			?>
		<div class="row">
			<div class="alert alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Record tidak ditemukan</strong>
			</div>
		</div>
			<?php
		}
		?>
		
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
							echo "<td>$no. </td>";
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
		
	</div>
</div>
