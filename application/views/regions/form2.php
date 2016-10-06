<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('regions/save/'.$region_info->region_id, array('id'=>'region_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="region_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('regions_name'), 'name', array('class'=>'required control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'name',
						'id'=>'name',
						'class'=>'form-control input-sm',
						'value'=>$region_info->name)
						);?>
			</div>
		</div>

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('regions_description'), 'description', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_textarea(array(
						'name'=>'description',
						'id'=>'description',
						'class'=>'form-control input-sm',
						'value'=>$region_info->description)
						);?>
			</div>
		</div>

	</fieldset>
<?php echo form_close(); ?>