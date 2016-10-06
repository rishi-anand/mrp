<?php
class Region extends CI_Model
{
	/*
	Determines if a given item_id is an item kit
	*/
	public function exists($region_id)
	{
		$this->db->from('regions');
		$this->db->where('region_id', $region_id);

		return ($this->db->get()->num_rows() == 1);
	}

	/*
	Gets total of rows
	*/
	public function get_total_rows()
	{
		$this->db->from('regions');

		return $this->db->count_all_results();
	}
	
	/*
	Gets information about a particular item kit
	*/
	public function get_info($region_id)
	{
		$this->db->from('regions');
		$this->db->where('region_id', $region_id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $region_id is NOT an item kit
			$item_obj = new stdClass();

			//Get all the fields from items table
			foreach($this->db->list_fields('regions') as $field)
			{
				$item_obj->$field = '';
			}
			return $item_obj;
		}
	}

	/*
	Gets information about multiple item kits
	*/
	public function get_multiple_info($region_ids)
	{
		$this->db->from('regions');
		$this->db->where_in('region_id', $region_ids);
		$this->db->order_by('name', 'asc');

		return $this->db->get();
	}

	/*
	Inserts or updates an item kit
	*/
	public function save(&$region_data, $region_id = FALSE)
	{
		if(!$region_id || !$this->exists($region_id))
		{
			if($this->db->insert('regions', $region_data))
			{
				$region_data['region_id'] = $this->db->insert_id();

				return TRUE;
			}

			return FALSE;
		}

		$this->db->where('region_id', $region_id);

		return $this->db->update('regions', $region_data);
	}

	/*
	Deletes one item kit
	*/
	public function delete($region_id)
	{
		return $this->db->delete('regions', array('region_id' => $id)); 	
	}

	/*
	Deletes a list of item kits
	*/
	public function delete_list($region_ids)
	{
		echo json_encode($region_ids,true);
		$this->db->where_in('regions.region_id', $region_ids);
		return $this->db->delete('regions');
 	}

	public function get_search_suggestions($search, $limit = 25)
	{
		$suggestions = array();

		$this->db->from('regions');

		//KIT #
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->like('region_id', str_ireplace('REG ', '', $search));
			$this->db->order_by('region_id', 'asc');

			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => 'REG '. $row->region_id, 'label' => 'REG ' . $row->region_id);
			}
		}
		else
		{
			$this->db->like('name', $search);
			$this->db->order_by('name', 'asc');

			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => 'REG ' . $row->region_id, 'label' => $row->name);
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
		$this->db->from('regions');
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);

		//KIT #
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->or_like('region_id', str_ireplace('REG ', '', $search));
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
		$this->db->from('regions');
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);

		//KIT #
		if(stripos($search, 'REG ') !== FALSE)
		{
			$this->db->or_like('region_id', str_ireplace('REG ', '', $search));
		}

		return $this->db->get()->num_rows();
	}
}
?>