<?php 

class Model_modules extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active Module information*/
	public function getActiveModule()
	{
		$sql = "SELECT * FROM modules WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the Module data */
	public function getModuleData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM modules WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM modules";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('modules', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('modules', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('modules');
			return ($delete == true) ? true : false;
		}
	}

}