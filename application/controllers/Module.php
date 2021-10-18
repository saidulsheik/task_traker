<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Module';

		$this->load->model('model_modules');
		$this->load->model('model_projects');
	}

	/* 
	* It only redirects to the manage Module Status page 
	*/
	public function index(){
		if(!in_array('viewModule', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->data['projects'] = $this->model_projects->getActiveProject();
		$this->render_template('module/index', $this->data);
	}

	/*
	* Fetches the Module data from the Module table 
	* this function is called from the datatable ajax function
	*/
	public function fetchModuleData(){
		$result = array('data' => array());
		$data = $this->model_modules->getModuleData();
		foreach ($data as $key => $value) {
			
			// button
			$buttons = '';
			if(in_array('viewModule', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editModule('.$value['id'].')" data-toggle="modal" data-target="#editModuleModal"><i class="fa fa-pencil"></i></button>';	
			}
			if(in_array('deleteModule', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeModule('.$value['id'].')" data-toggle="modal" data-target="#removeModuleModal"><i class="fa fa-trash"></i></button>
				';
			}
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$result['data'][$key] = array(
				$value['module_name'],
				$value['description'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the Module id and retreives
	* the Module information from the Module model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchModuleDataById($id)
	{
		if($id) {
			$data = $this->model_modules->getModuleData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the Module form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createModule', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('module_name', 'Module Name', 'trim|required|is_unique[modules.module_name]');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'module_name' => $this->input->post('module_name'),
        		'description' => $this->input->post('description'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_modules->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Module information';			
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
	* Its checks the Module form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateModule', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {

			if(trim($this->input->post('edit_module_name')) != trim($this->input->post('old_module_name'))){
				$this->form_validation->set_rules('edit_module_name', 'Module Name', 'trim|required|is_unique[modules.module_name]');
			} else {
				$this->form_validation->set_rules('edit_module_name', 'Module Name', 'trim|required');
			}
			$this->form_validation->set_rules('edit_description', 'Description', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'module_name' 	=> $this->input->post('edit_module_name'),
	        		'description' 	=> $this->input->post('edit_description'),
	        		'active' 		=> $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_modules->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the Module information';			
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
	* It removes the Module information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteModule', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');
		$response = array();
		if($id) {
			$delete = $this->model_modules->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the Module information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}