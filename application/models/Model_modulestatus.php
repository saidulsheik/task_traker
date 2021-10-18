<?php 

class Model_modulestatus extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active ModuleStatus information*/
	public function getActiveModuleStatus()
	{
		$sql = "SELECT * FROM modules_status WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the ModuleStatus data */
	public function getModuleStatusData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM modules_status WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM modules_status";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('modules_status', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('modules_status', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('modules_status');
			return ($delete == true) ? true : false;
		}
	}

}