<?php
class Region_item_customers extends CI_Model
{
	/*
	Gets item kit items for a particular item kit
	*/
	public function get_info($item_id)
	{
		$this->db->from('region_item_customers');
		$this->db->where('item_id', $item_id);
		
		//return an array of item kit items for an item
		return $this->db->get()->result_array();
		//echo json_encode($this->db->get()->result_array(),true);
	}
	
	/*
	Inserts or updates an item kit's items
	*/
	public function save(&$region_item_customers_data, $item_id)
	{
		$success = TRUE;
		//echo $region_items_data;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->delete($item_id);
		
		foreach($region_item_customers_data as $row)
		{
			//echo $region_id;
			$row['item_id'] = $item_id;
			$success &= $this->db->insert('region_item_customers', $row);
			echo $row;	
		}
		
		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}
	
	/*
	Deletes item kit items given an item kit
	*/
	public function delete($item_id)
	{
		return $this->db->delete('region_item_customers', array('item_id' => $item_id));
	}
}
?>
