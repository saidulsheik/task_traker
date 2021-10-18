<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TasksPriority extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Tasks Priority';
		
		$this->load->model('model_tasksPriority');
	}

	/* 
	* It only redirects to the manage TasksPriority Status page 
	*/
	public function index(){
		if(!in_array('viewTasksPriority', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('tasksPriority/index', $this->data);
	}

	/*
	* Fetches the TasksPriority data from the TasksPriority table 
	* this function is called from the datatable ajax function
	*/
	public function fetchTasksPriorityData(){
		$result = array('data' => array());
		$data = $this->model_TasksPriority->getTasksPriorityData();
		foreach ($data as $key => $value) {
			print
			// button
			$buttons = '';
			if(in_array('viewTasksPriority', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editTasksPriority('.$value['id'].')" data-toggle="modal" data-target="#editTasksPriorityModal"><i class="fa fa-pencil"></i></button>';	
			}
			if(in_array('deleteTasksPriority', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeTasksPriority('.$value['id'].')" data-toggle="modal" data-target="#removeTasksPriorityModal"><i class="fa fa-trash"></i></button>
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
	* It checks if it gets the TasksPriority id and retreives
	* the TasksPriority information from the TasksPriority model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchTasksPriorityDataById($id)
	{
		if($id) {
			$data = $this->model_TasksPriority->getTasksPriorityData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the TasksPriority form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createTasksPriority', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('level_name', 'TasksPriority Name', 'trim|required|is_unique[tasks_labels.level_name]');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'level_name' => $this->input->post('level_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_TasksPriority->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the TasksPriority information';			
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
	* Its checks the TasksPriority form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateTasksPriority', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {

			if(trim($this->input->post('edit_level_name')) != trim($this->input->post('old_level_name'))){
				$this->form_validation->set_rules('edit_level_name', 'TasksPriority Name', 'trim|required|is_unique[tasks_labels.level_name]');
			} else {
				$this->form_validation->set_rules('edit_level_name', 'TasksPriority Name', 'trim|required');
			}
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'level_name' 	=> $this->input->post('edit_level_name'),
	        		'active' 		=> $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_TasksPriority->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the TasksPriority information';			
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
	* It removes the TasksPriority information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteTasksPriority', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');
		$response = array();
		if($id) {
			$delete = $this->model_TasksPriority->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the TasksPriority information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}