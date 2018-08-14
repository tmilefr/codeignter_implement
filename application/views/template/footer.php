<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

		<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
			<ul class="navbar-nav mr-auto"> 
				<li class="nav-item">
				<?php echo ((isset($this->pagination)) ? $this->pagination->create_links():'');?>
				</li>
				<li class="nav-item">
					
				</li>
				<li class="nav-item">
					<?php echo ((isset($this->pagination)) ? $this->pagination->create_perpage():'');?>
				</li>
				<li class="nav-item">
				<?php echo $footer_line;?>
				</li> 
			</ul>
			<span class="navbar-text">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></span>
		</nav>


	</div>
</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        $('#sidebar').toggleClass('active');
        e.preventDefault();
    });
    </script>    
    
  </body>
</html>
