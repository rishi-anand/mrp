<?php
class Region_items extends CI_Model
{
	/*
	Gets item kit items for a particular item kit
	*/
	public function get_info($region_id)
	{
		$this->db->from('region_items');
		$this->db->where('region_id', $region_id);
		
		//return an array of item kit items for an item
		return $this->db->get()->result_array();
	}
	
	/*
	Inserts or updates an item kit's items
	*/
	public function save(&$region_items_data, $region_id)
	{
		$success = TRUE;
		echo $region_items_data;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->delete($region_id);
		
		foreach($region_items_data as $row)
		{
			echo $region_id;
			$row['region_id'] = $region_id;
			$success &= $this->db->insert('region_items', $row);
			echo $row;	
		}
		
		$this->db->trans_complete();

		$success &= $this->db->trans_status();

		return $success;
	}
	
	/*
	Deletes item kit items given an item kit
	*/
	public function delete($region_id)
	{
		return $this->db->delete('region_items', array('region_id' => $region_id)); 
	}
}
?>
