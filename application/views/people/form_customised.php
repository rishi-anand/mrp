<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_account_group'), 'account_group', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'account_group',
				'id'=>'account_group',
				'class'=>'form-control input-sm',
				'value'=>$person_info->account_group)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_contact_person'), 'contact_person', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'contact_person',
				'id'=>'contact_person',
				'class'=>'form-control input-sm',
				'value'=>$person_info->contact_person)
				);?>
	</div>
</div>


<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_area_master'), 'area_master', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'area_master',
				'id'=>'area_master',
				'class'=>'form-control input-sm',
				'value'=>$person_info->area_master)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_city_master'), 'city_master', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'city_master',
				'id'=>'city_master',
				'class'=>'form-control input-sm',
				'value'=>$person_info->city_master)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_district_master'), 'district_master', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'district_master',
				'id'=>'district_master',
				'class'=>'form-control input-sm',
				'value'=>$person_info->district_master)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_opening_date'), 'state', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<?php echo form_input(array(
				'name'=>'common_opening_date',
				'id'=>'common_opening_date',
				'placeholder'=>'yyyy-mm-dd',
				'class'=>'form-control input-sm',
				'value'=>$person_info->common_opening_date)
				);?>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_phone_number_2'), 'phone_number_2', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-phone-alt"></span></span>
			<?php echo form_input(array(
					'name'=>'phone_number_2',
					'id'=>'phone_number_2',
					'class'=>'form-control input-sm',
					'value'=>$person_info->phone_number_2)
					);?>
		</div>
	</div>
</div>

<div class="form-group form-group-sm">	
	<?php echo form_label($this->lang->line('common_phone_number_3'), 'phone_number_3', array('class'=>'control-label col-xs-3')); ?>
	<div class='col-xs-8'>
		<div class="input-group">
			<span class="input-group-addon input-sm"><span class="glyphicon glyphicon-phone-alt"></span></span>
			<?php echo form_input(array(
					'name'=>'phone_number_3',
					'id'=>'phone_number_3',
					'class'=>'form-control input-sm',
					'value'=>$person_info->phone_number_3)
					);?>
		</div>
	</div>
</div>