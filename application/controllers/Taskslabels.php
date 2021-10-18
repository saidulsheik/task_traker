<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TasksLabels extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'TasksLabels Status';
		
		$this->load->model('model_taskslabels');
	}

	/* 
	* It only redirects to the manage TasksLabels Status page 
	*/
	public function index(){
		if(!in_array('viewTasksLabels', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('tasksLabels/index', $this->data);
	}

	/*
	* Fetches the TasksLabels data from the TasksLabels table 
	* this function is called from the datatable ajax function
	*/
	public function fetchTasksLabelsData(){
		$result = array('data' => array());
		$data = $this->model_taskslabels->getTasksLabelsData();
		foreach ($data as $key => $value) {
			print
			// button
			$buttons = '';
			if(in_array('viewTasksLabels', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editTasksLabels('.$value['id'].')" data-toggle="modal" data-target="#editTasksLabelsModal"><i class="fa fa-pencil"></i></button>';	
			}
			if(in_array('deleteTasksLabels', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeTasksLabels('.$value['id'].')" data-toggle="modal" data-target="#removeTasksLabelsModal"><i class="fa fa-trash"></i></button>
				';
			}
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$result['data'][$key] = array(
				$value['level_name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the TasksLabels id and retreives
	* the TasksLabels information from the TasksLabels model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchTasksLabelsDataById($id)
	{
		if($id) {
			$data = $this->model_taskslabels->getTasksLabelsData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the TasksLabels form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createTasksLabels', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('level_name', 'TasksLabels Name', 'trim|required|is_unique[tasks_labels.level_name]');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'level_name' => $this->input->post('level_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_taskslabels->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the TasksLabels information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);

	}

	/*
	* Its checks the TasksLabels form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateTasksLabels', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {

			if(trim($this->input->post('edit_level_name')) != trim($this->input->post('old_level_name'))){
				$this->form_validation->set_rules('edit_level_name', 'TasksLabels Name', 'trim|required|is_unique[tasks_labels.level_name]');
			} else {
				$this->form_validation->set_rules('edit_level_name', 'TasksLabels Name', 'trim|required');
			}
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'level_name' 	=> $this->input->post('edit_level_name'),
	        		'active' 		=> $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_taskslabels->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the TasksLabels information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* It removes the TasksLabels information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteTasksLabels', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');
		$response = array();
		if($id) {
			$delete = $this->model_taskslabels->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the TasksLabels information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}