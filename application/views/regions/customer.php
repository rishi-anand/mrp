<?php $this->load->view("partial/header"); ?>
<div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>

<ul id="error_message_box" class="error_message_box"></ul>

<?php echo form_open('regions/save_item_person/'.$region_info->region_id, array('id'=>'region_form', 'class'=>'form-horizontal')); ?>
	<fieldset id="region_basic_info">
		<div class="form-group form-group-sm">
			<?php echo form_label($this->lang->line('regions_person'), 'person', array('class'=>'control-label col-xs-3')); ?>
			<div class='col-xs-8'>
				<?php echo form_input(array(
						'name'=>'person',
						'id'=>'person',
						'class'=>'form-control input-sm')
						);?>
			</div>
		</div>

		<table id="item_customers" class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="10%"><?php echo $this->lang->line('common_delete'); ?></th>
					<th width="70%"><?php echo $this->lang->line('regions_item'); ?></th>
					<th width="20%"><?php echo $this->lang->line('regions_quantity'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($item_customers as $item_customer)
				{
				?>
					<tr>
						<td><a href='#' onclick='return delete_item_kit_row(this);'><span class='glyphicon glyphicon-trash'></span></a></td>
						<td><?php echo $item_customer['name']; ?></td>
						<td><input class='quantity form-control input-sm' id='item_kit_item_<?php echo $item_customer['item_id'] ?>' name=item_customer[<?php echo $item_customer['item_id'] ?>] value='<?php echo to_quantity_decimals($item_customer['quantity']) ?>'/></td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>

	</fieldset>
<?php echo form_close(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">

//var $ = jQuery;
//validation and submit handling
$(document).ready(function()
{
	$("#item").autocomplete({
		source: '<?php echo site_url("customers/suggest"); ?>',
		minChars:0,
		autoFocus: false,
		delay:10,
		appendTo: ".modal-content",
		select: function(e, ui) {
			if ($("#item_customer_" + ui.item.value).length == 1)
			{
				$("#item_customer_" + ui.item.value).val(parseFloat( $("#item_kit_item_" + ui.item.value).val()) + 1);
			}
			else
			{
				$("#item_customers").append("<tr><td><a href='#' onclick='return delete_item_kit_row(this);'><span class='glyphicon glyphicon-trash'></span></a></td><td>" + ui.item.label + "</td><td><input class='quantity form-control input-sm' id='item_customer_" + ui.item.value + "' type='text' name=item_customer[" + ui.item.value + "] value='1'/></td></tr>");
			}
			$("#item").val("");
			return false;
		}
	});
});

function delete_item_kit_row(link)
{
	$(link).parent().parent().remove();
	return false;
}

</script>
<?php $this->load->view("partial/footer"); ?>