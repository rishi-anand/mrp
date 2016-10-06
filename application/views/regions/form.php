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

		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('regions_add_item'), 'item', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'item',
						'id'=>'item',
						'class'=>'form-control input-sm')
						);?>
			</div>
		</div>

		<table id="region_items" class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="10%"><?php echo $this->lang->line('common_delete'); ?></th>
					<th width="70%"><?php echo $this->lang->line('regions_item'); ?></th>
					<th width="20%"><?php echo $this->lang->line('regions_quantity'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($region_items as $region_item)
				{
				?>
					<tr>
						<td><a href='#' onclick='return delete_item_kit_row(this);'><span class='glyphicon glyphicon-trash'></span></a></td>
						<td><?php echo $region_item['name']; ?></td>
						<td><input class='quantity form-control input-sm' id='item_kit_item_<?php echo $region_item['item_id'] ?>' name=region_item[<?php echo $region_item['item_id'] ?>] value='<?php echo to_quantity_decimals($region_item['quantity']) ?>'/></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</fieldset>
<?php echo form_close(); ?>

<script type="text/javascript">

var link = '<?php echo site_url($controller_name."/view_item_cusomers"); ?>';
console.log(link);
//validation and submit handling
$(document).ready(function()
{
	$("#item").autocomplete({
		source: '<?php echo site_url("items/suggest"); ?>',
		minChars:0,
		autoFocus: false,
		delay:10,
		appendTo: ".modal-content",
		select: function(e, ui) {
			if ($("#item_kit_item_" + ui.item.value).length == 1)
			{
				$("#item_kit_item_" + ui.item.value).val(parseFloat( $("#item_kit_item_" + ui.item.value).val()) + 1);
			}
			else
			{
				$("#region_items").append("<tr><td><a href='#' onclick='return delete_item_kit_row(this);'><span class='glyphicon glyphicon-trash'></span></a></td><td>" + ui.item.label + "</td><td><a href='"+ link +"'><input type='button' class='quantity form-control input-sm' id='item_kit_item_" + ui.item.value + "' type='text' name=region_item[" + ui.item.value + "] value='Add Customer'/><a></td></tr>");
			}
			$("#item").val("");
			return false;
		}
	});

	$('#item_kit_form').validate($.extend({
		submitHandler:function(form)
		{
		$(form).ajaxSubmit({
			success:function(response)
			{
				dialog_support.hide();
				table_support.handle_submit('<?php echo site_url('item_kits'); ?>', response);
			},
			dataType:'json'
		});

		},
		rules:
		{
			name:"required",
			category:"required"
		},
		messages:
		{
			name:"<?php echo $this->lang->line('items_name_required'); ?>",
			category:"<?php echo $this->lang->line('items_category_required'); ?>"
		}
	}, form_support.error));
});

function delete_item_kit_row(link)
{
	$(link).parent().parent().remove();
	return false;
}

</script>