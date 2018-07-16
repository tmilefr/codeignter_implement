<div class="container-fluid">
	<table class="table table-sm">
	  <thead>
		<tr>
			<?php
			foreach($fields AS $key=>$field){
				echo '<th scope="col">'.$this->bootstrap_tools->render_link($field).'</a></th>';
			}
			?>
		  </tr>
	  </thead>
	  <tbody>
	<?php 

	foreach($datas AS $key => $data){
		echo '<tr>';
		foreach($fields AS $key=>$field){
			echo '<td>'.$data->{$field}.'</td>';
		}			
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
</div>
