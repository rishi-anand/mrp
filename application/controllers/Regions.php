<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Regions extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('regions');
		$this->load->database();
	}
	
	public function index()
	{
		$data['table_headers'] = $this->xss_clean(get_regions_manage_table_headers());

		$this->load->view('regions/manage', $data);
	}

	public function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}

	/*
	Returns Item kits table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$regions = $this->Region->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->Region->get_found_rows($search);

		$data_rows = array();
		foreach($regions->result() as $region)
		{
			// calculate the total cost and retail price of the Kit so it can be printed out in the manage table
			$data_rows[] = get_region_data_row($region, $this);
		}

		$data_rows = $this->xss_clean($data_rows);

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}

	public function suggest_search()
	{
		$suggestions = $this->xss_clean($this->Region->get_search_suggestions($this->input->post('term')));

		echo json_encode($suggestions);
	}

	public function get_row($row_id)
	{
		// calculate the total cost and retail price of the Kit so it can be added to the table refresh
		$region = $this->Region->get_info($row_id);
		
		echo json_encode(get_region_data_row($region, $this));
	}
	
	public function view($region_id = -1)
	{
		$info = $this->Region->get_info($region_id);
		foreach(get_object_vars($info) as $property => $value)
		{
			$info->$property = $this->xss_clean($value);
		}
		$data['region_info']  = $info;
		//echo json_encode($data,true);
		$items = array();
		//echo json_encode($items,true);
		//echo $region_id;
		foreach($this->Region_items->get_info($region_id) as $region_item)
		{
			//echo json_encode($region_item,true);
			$item['name'] = $this->xss_clean($this->Item->get_info($region_item['item_id'])->name);
			$item['item_id'] = $this->xss_clean($region_item['item_id']);
			
			$items[] = $item;
		}
		//echo json_encode($items,true);
		$data['region_items'] = $items;
		//echo json_encode($data,true);

		$this->load->view("regions/form", $data);
	}

		public function view_item_person($region_id = -1)
	   {
		$info = $this->Region->get_info($region_id);
		foreach(get_object_vars($info) as $property => $value)
		{
			$info->$property = $this->xss_clean($value);
		}
		$data['region_info']  = $info;
		//echo json_encode($data,true);
		$items = array();
		//echo json_encode($items,true);
		//echo $region_id;
		foreach($this->Region_items->get_info($region_id) as $region_item)
		{
			echo json_encode($region_item,true);
			$item['name'] = $this->xss_clean($this->Item->get_info($region_item['item_id'])->name);
			$item['item_id'] = $this->xss_clean($region_item['item_id']);
			
			$items[] = $item;
		}
		//echo json_encode($items,true);
		$data['region_items'] = $items;
		//echo json_encode($data,true);

		$this->load->view("regions/add_item_person", $data);
	   }

		public function view_item_cusomers($item_id = -1)
	   {
	   	echo 'rishi';
	   		if($this->input->post('region_item') != NULL)
			{
				echo 'rishi';
				$region_items = array();
				foreach($this->input->post('region_item') as $item_id => $quantity)
				{
					
					$region_items[] = array(
						'item_id' => $item_id
					);
				}

                //echo $region_items;
                echo json_encode($region_items,true);
                //echo $region_id;
				//$success = $this->Region_items->save($region_items, $region_id);
			}
		//echo json_encode($data,true);
		$customers = array();
		//echo json_encode($items,true);
		//echo $region_id;
		$item_id = 1;
		foreach($this->Region_item_customers->get_info($item_id) as $item_customer)
		{
			//echo json_encode($item_customer,true);
			$customer['name'] = $this->xss_clean($this->Customer->get_info($item_customer['person_id'])->name);
			$customer['person_id'] = $this->xss_clean($item_customer['person_id']);
			$customers[] = $customer;
		}
		//echo json_encode($items,true);
		$data['item_customers'] = $customers;
		//echo json_encode($data,true);

		$this->load->view("regions/customer", $customers);
	   }
	
	public function save($region_id = -1)
	{
		$region_data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description')
		);
		//console_log( $region_data );
		if($this->Region->save($region_data, $region_id))
		{
			$success = TRUE;
			//New item kit
			if ($region_id == -1)
			{
				$region_id = $region_data['region_id'];
				//echo "rishi 2";
				//echo $region_data['region_id'];
			}
			
			if($this->input->post('region_item') != NULL)
			{
				echo 'rishi';
				$region_items = array();
				foreach($this->input->post('region_item') as $item_id => $quantity)
				{
					
					$region_items[] = array(
						'item_id' => $item_id
					);
				}

                //echo $region_items;
                echo json_encode($region_items,true);
                //echo $region_id;
				$success = $this->Region_items->save($region_items, $region_id);
			}

            
            echo json_encode($region_items,true);
			$region_data = $this->xss_clean($region_data);

			echo json_encode(array('success' => $success,
								'message' => $this->lang->line('regions_successful_adding').' '.$region_data['name'].' ,'.$region_items['item_id'], 'id' => $region_id));
		}
		else//failure
		{
			$item_kit_data = $this->xss_clean($item_kit_data);

			echo json_encode(array('success' => FALSE, 
								'message' => $this->lang->line('regions_error_adding_updating').' '.$region_data['name'], 'id' => -1));
		}
	}

		public function save_item_person($region_id = -1)
	{		
			if($this->input->post('region_item') != NULL)
			{
				echo 'rishi';
				$region_items = array();
				foreach($this->input->post('region_item') as $item_id => $quantity)
				{
					
					$region_items[] = array(
						'item_id' => $item_id
					);
				}

                //echo $region_items;
                echo json_encode($region_items,true);
                //echo $region_id;
				$success = $this->Region_items->save($region_items, $region_id);
			}

            
            echo json_encode($region_items,true);
			$region_data = $this->xss_clean($region_data);

			echo json_encode(array('success' => $success,
								'message' => $this->lang->line('regions_successful_adding').' '.$region_data['name'].' ,'.$region_items['item_id'], 'id' => $region_id));
		
	}
	
	public function delete()
	{
		$regions_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->Region->delete_list($regions_to_delete))
		{
			echo json_encode(array('success' => TRUE,
								'message' => $this->lang->line('item_kits_successful_deleted').' '.count($item_kits_to_delete).' '.$this->lang->line('item_kits_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE,
								'message' => $this->lang->line('item_kits_cannot_be_deleted')));
		}
	}
	
	public function generate_barcodes($item_kit_ids)
	{
		$this->load->library('barcode_lib');
		$result = array();

		$item_kit_ids = explode(':', $item_kit_ids);
		foreach($item_kit_ids as $item_kid_id)
		{		
			// calculate the total cost and retail price of the Kit so it can be added to the barcode text at the bottom
			$item_kit = $this->_add_totals_to_item_kit($this->Item_kit->get_info($item_kid_id));
			
			$item_kid_id = 'KIT '. urldecode($item_kid_id);

			$result[] = array('name' => $item_kit->name, 'item_id' => $item_kid_id, 'item_number' => $item_kid_id,
							'cost_price' => $item_kit->total_cost_price, 'unit_price' => $item_kit->total_unit_price);
		}

		$data['items'] = $result;
        $barcode_config = $this->barcode_lib->get_barcode_config();
		// in case the selected barcode type is not Code39 or Code128 we set by default Code128
		// the rationale for this is that EAN codes cannot have strings as seed, so 'KIT ' is not allowed
		if($barcode_config['barcode_type'] != 'Code39' && $barcode_config['barcode_type'] != 'Code128')
		{
			$barcode_config['barcode_type'] = 'Code128';
		}
		$data['barcode_config'] = $barcode_config;

		// display barcodes
		$this->load->view("barcodes/barcode_sheet", $data);
	}
}
?>