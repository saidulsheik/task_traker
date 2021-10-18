<?php 

class Model_projects extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active Project information*/
	public function getActiveProject()
	{
		$sql = "SELECT * FROM projects WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the Project data */
	public function getProjectData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM projects WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM projects";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('projects', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('projects', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('projects');
			return ($delete == true) ? true : false;
		}
	}

}