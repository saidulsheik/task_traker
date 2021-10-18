<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modulestatus extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Module Status';

		$this->load->model('model_modulestatus');
	}

	/* 
	* It only redirects to the manage Module Status page 
	*/
	public function index(){
		if(!in_array('viewModuleStatus', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('modulestatus/index', $this->data);
	}

	/*
	* Fetches the ModuleStatus data from the ModuleStatus table 
	* this function is called from the datatable ajax function
	*/
	public function fetchModuleStatusData(){
		$result = array('data' => array());
		$data = $this->model_modulestatus->getModuleStatusData();
		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			if(in_array('viewModuleStatus', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editModuleStatus('.$value['id'].')" data-toggle="modal" data-target="#editModuleStatusModal"><i class="fa fa-pencil"></i></button>';	
			}
			if(in_array('deleteModuleStatus', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeModuleStatus('.$value['id'].')" data-toggle="modal" data-target="#removeModuleStatusModal"><i class="fa fa-trash"></i></button>
				';
			}
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$result['data'][$key] = array(
				$value['status_name'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the ModuleStatus id and retreives
	* the ModuleStatus information from the ModuleStatus model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchModuleStatusDataById($id)
	{
		if($id) {
			$data = $this->model_modulestatus->getModuleStatusData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the ModuleStatus form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createModuleStatus', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('status_name', 'status_name', 'trim|required|is_unique[modules_status.status_name]');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'status_name' => $this->input->post('status_name'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_modulestatus->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the ModuleStatus information';			
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
	* Its checks the ModuleStatus form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateModuleStatus', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_status_name', 'Module Status Name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'status_name' => $this->input->post('edit_status_name'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_modulestatus->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the ModuleStatus information';			
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
	* It removes the ModuleStatus information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteModuleStatus', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');
		$response = array();
		if($id) {
			$delete = $this->model_modulestatus->remove($id);

			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the ModuleStatus information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}