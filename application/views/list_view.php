<div class="container-fluid">
	
	<table class="table table-sm">
	  <thead>
		<tr>			
			<th scope="col">&nbsp;</th>
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
		echo '<td><a href="'.base_url().$_controller_name.'/delete/'.$data->id.'"><span class="oi oi-circle-x"></span></a><a href="'.base_url().$_controller_name.'/edit/'.$data->id.'"><span class="oi oi-pencil"></span></a></td>';	

		foreach($fields AS $key=>$field){
			echo '<td>'.$this->render_object->RenderElement($field, $data->{$field}).'</td>';
		}		
		echo '</tr>';
	}
	?>
	</tbody>
	</table>
</div>
