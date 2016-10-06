<?php
class Region extends CI_Model
{
	/*
	Determines if a given item_id is an item kit
	*/
<<<<<<< HEAD
	public function exists($region_id)
	{
		$this->db->from('regions');
		$this->db->where('region_id', $region_id);

		return ($this->db->get()->num_rows() == 1);
=======
	public function exists($item_id)
	{
		

		$item_id = 1;
		echo "rishi_1";
		$this->db->from('item_kits');
		$this->db->where('item_kit_id', $item_id);
        $query = $this->db->get();
        echo $query;
        echo "rishi";
        if($query->num_rows()==1)
		{
			
			echo "rishi_2";
			echo $query->row();
			return $query->row();

		}

		//return ($this->db->get()->num_rows() == 1); 
		/*
		$item_id = 1;
		//echo "rishi_1";	
				$this->db->from('items');
		$this->db->where('CAST(item_id AS CHAR) = ', $item_id);
		
			$this->db->where('deleted', $deleted);
			$query = $this->db->get();
			echo $query;
		

		return ($this->db->get()->num_rows() == 1); */
>>>>>>> receipt
	}

	/*
	Gets total of rows
	*/
	public function get_total_rows()
	{
<<<<<<< HEAD
		$this->db->from('regions');
=======
		$this->db->from('item_kits');
>>>>>>> receipt

		return $this->db->count_all_results();
	}
	
	/*
	Gets information about a particular item kit
	*/
<<<<<<< HEAD
	public function get_info($region_id)
	{
		$this->db->from('regions');
		$this->db->where('region_id', $region_id);
=======
	public function get_info($item_kit_id)
	{
		$this->db->from('item_kits');
		$this->db->where('item_kit_id', $item_kit_id);
>>>>>>> receipt
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
<<<<<<< HEAD
			//Get empty base parent object, as $region_id is NOT an item kit
			$item_obj = new stdClass();

			//Get all the fields from items table
			foreach($this->db->list_fields('regions') as $field)
			{
				$item_obj->$field = '';
			}
=======
			//Get empty base parent object, as $item_kit_id is NOT an item kit
			$item_obj = new stdClass();

			//Get all the fields from items table
			foreach($this->db->list_fields('item_kits') as $field)
			{
				$item_obj->$field = '';
			}

>>>>>>> receipt
			return $item_obj;
		}
	}

	/*
	Gets information about multiple item kits
	*/
<<<<<<< HEAD
	public function get_multiple_info($region_ids)
	{
		$this->db->from('regions');
		$this->db->where_in('region_id', $region_ids);
=======
	public function get_multiple_info($item_kit_ids)
	{
		$this->db->from('item_kits');
		$this->db->where_in('item_kit_id', $item_kit_ids);
>>>>>>> receipt
		$this->db->order_by('name', 'asc');

		return $this->db->get();
	}

	/*
	Inserts or updates an item kit
	*/
<<<<<<< HEAD
	public function save(&$region_data, $region_id = FALSE)
	{
		if(!$region_id || !$this->exists($region_id))
		{
			if($this->db->insert('regions', $region_data))
			{
				$region_data['region_id'] = $this->db->insert_id();
=======
	public function save(&$item_kit_data, $item_kit_id = FALSE)
	{
		if(!$item_kit_id || !$this->exists($item_kit_id))
		{
			if($this->db->insert('item_kits', $item_kit_data))
			{
				$item_kit_data['item_kit_id'] = $this->db->insert_id();
>>>>>>> receipt

				return TRUE;
			}

			return FALSE;
		}

<<<<<<< HEAD
		$this->db->where('region_id', $region_id);

		return $this->db->update('regions', $region_data);
=======
		$this->db->where('item_kit_id', $item_kit_id);

		return $this->db->update('item_kits', $item_kit_data);
>>>>>>> receipt
	}

	/*
	Deletes one item kit
	*/
<<<<<<< HEAD
	public function delete($region_id)
	{
		return $this->db->delete('regions', array('region_id' => $id)); 	
=======
	public function delete($item_kit_id)
	{
		return $this->db->delete('item_kits', array('item_kit_id' => $id)); 	
>>>>>>> receipt
	}

	/*
	Deletes a list of item kits
	*/
<<<<<<< HEAD
	public function delete_list($region_ids)
	{
		$this->db->where_in('region_id', $region_ids);
		return $this->db->delete('regions');
=======
	public function delete_list($item_kit_ids)
	{
		$this->db->where_in('item_kit_id', $item_kit_ids);

		return $this->db->delete('item_kits');		
>>>>>>> receipt
 	}

	public function get_search_suggestions($search, $limit = 25)
	{
		$suggestions = array();

<<<<<<< HEAD
		$this->db->from('regions');

		//KIT #
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->like('region_id', str_ireplace('REG ', '', $search));
			$this->db->order_by('region_id', 'asc');

			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => 'REG '. $row->region_id, 'label' => 'REG ' . $row->region_id);
=======
		$this->db->from('item_kits');

		//KIT #
		if(stripos($search, 'KIT ') !== FALSE)
		{
			$this->db->like('item_kit_id', str_ireplace('KIT ', '', $search));
			$this->db->order_by('item_kit_id', 'asc');

			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => 'KIT '. $row->item_kit_id, 'label' => 'KIT ' . $row->item_kit_id);
>>>>>>> receipt
			}
		}
		else
		{
			$this->db->like('name', $search);
			$this->db->order_by('name', 'asc');

			foreach($this->db->get()->result() as $row)
			{
<<<<<<< HEAD
				$suggestions[] = array('value' => 'REG ' . $row->region_id, 'label' => $row->name);
=======
				$suggestions[] = array('value' => 'KIT ' . $row->item_kit_id, 'label' => $row->name);
>>>>>>> receipt
			}
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

	/*
	Perform a search on items
	*/
	public function search($search, $rows=0, $limit_from=0, $sort='name', $order='asc')
	{
<<<<<<< HEAD
		$this->db->from('regions');
=======
		$this->db->from('item_kits');
>>>>>>> receipt
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);

		//KIT #
<<<<<<< HEAD
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->or_like('region_id', str_ireplace('REG ', '', $search));
=======
		if(stripos($search, 'KIT ') !== FALSE)
		{
			$this->db->or_like('item_kit_id', str_ireplace('KIT ', '', $search));
>>>>>>> receipt
		}

		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();	
	}
	
	public function get_found_rows($search)
	{
<<<<<<< HEAD
		$this->db->from('regions');
=======
		$this->db->from('item_kits');
>>>>>>> receipt
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);

		//KIT #
<<<<<<< HEAD
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->or_like('region_id', str_ireplace('REG ', '', $search));
=======
		if(stripos($search, 'KIT ') !== FALSE)
		{
			$this->db->or_like('item_kit_id', str_ireplace('KIT ', '', $search));
>>>>>>> receipt
		}

		return $this->db->get()->num_rows();
	}
}
?>