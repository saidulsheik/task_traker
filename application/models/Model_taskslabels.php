<?php 

class Model_taskslabels extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active TasksLabels information*/
	public function getActiveTasksLabels()
	{
		$sql = "SELECT * FROM tasks_labels WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the TasksLabels data */
	public function getTasksLabelsData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tasks_labels WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tasks_labels";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('tasks_labels', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tasks_labels', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tasks_labels');
			return ($delete == true) ? true : false;
		}
	}

}