		</div>
	</div>

	<div id="footer">
		<div class="jumbotron push-spaces" style="display:none;">
			<strong><?php echo $this->lang->line('common_you_are_using_ospos'); ?>
  			<?php echo $this->config->item('application_version'); ?> - <?php echo substr('$Id: 4f5ad5761503bbc94152cbf16afa76439ca155b8 $', 5, 7); ?></strong>.
			<?php echo $this->lang->line('common_please_visit_my'); ?>
			<a href="https://github.com/jekkos/opensourcepos" target="_blank"><?php echo $this->lang->line('common_website'); ?></a>
			<?php echo $this->lang->line('common_learn_about_project'); ?>
		</div>
	</div>

	<div id="footer" style="position:fixed;font-size:11px;color:#777;clear:both;bottom:0;left:0;height:40px;width:100%;">
		<div class="jumbotron push-spaces">
			<center><strong>MRP Solutions</strong></center>
		</div>
	</div>

	<script>
	var t = 0;
		var x = setTimeout(function(){
			$.unblockUI();
			var y = setTimeout(function(){
			$.unblockUI();
			clearTimeout(y);
		},50);
			clearTimeout(x);
		},50);

		
	</script>
</body>
</html>
