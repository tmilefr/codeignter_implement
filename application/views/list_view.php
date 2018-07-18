<div class="container-fluid">
	
	<table class="table table-sm">
	  <thead>
		<tr>
			<?php
			foreach($fields AS $key=>$field){
				echo '<th scope="col">'.$this->bootstrap_tools->render_link($field).'</a></th>';
			}
			?>
			<th scope="col">&nbsp;</th>
		  </tr>
	  </thead>
	  <tbody>
	<?php 
	foreach($datas AS $key => $data){
		echo '<tr>';
		foreach($fields AS $key=>$field){
			echo '<td>'.$data->{$field}.'</td>';
		}		
		echo '<td><a href="'.base_url().$_controller_name.'/delete/'.$data->id.'"><span class="oi oi-circle-x"></span></a><a href="'.base_url().$_controller_name.'/edit/'.$data->id.'"><span class="oi oi-pencil"></span></a></td>';	
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
</div>
