<?php

class Announcement extends CI_Model {

	private $table = 'announcement';

    function __construct()
    {
        parent::__construct();
    }
    
    function insert_entry($data)
    {		
		$this->db->insert($this->table, array(
			'name' => $data['name'],
			'announcement' => $data['announcement']
		));
    }
	
	function delete_entry($id)
    {		
		$this->db->where('id', $id);
		$this->db->delete($this->table);
    }
	
	function get_announcement()
	{
		$query = $this->db->query("SELECT * FROM announcement;");		
		return array_reverse($query->result_array());
	

	}
}