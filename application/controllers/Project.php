<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Admin_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->not_logged_in();
		$this->data['page_title'] = 'Project';
		$this->load->model('model_projects');  
	}

	/* 
	* It only redirects to the manage Project Status page 
	*/
	public function index(){
		if(!in_array('viewProject', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$this->render_template('project/index', $this->data);
	}

	/*
	* Fetches the Project data from the Project table 
	* this function is called from the datatable ajax function
	*/
	public function fetchProjectData(){
		$result = array('data' => array());
		$data = $this->model_projects->getProjectData();
		foreach ($data as $key => $value) {
			print
			// button
			$buttons = '';
			if(in_array('viewProject', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editProject('.$value['id'].')" data-toggle="modal" data-target="#editProjectModal"><i class="fa fa-pencil"></i></button>';	
			}
			if(in_array('deleteProject', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeProject('.$value['id'].')" data-toggle="modal" data-target="#removeProjectModal"><i class="fa fa-trash"></i></button>
				';
			}
			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$result['data'][$key] = array(
				$value['project_name'],
				$value['description'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* It checks if it gets the Project id and retreives
	* the Project information from the Project model and 
	* returns the data into json format. 
	* This function is invoked from the view page.
	*/
	public function fetchProjectDataById($id)
	{
		if($id) {
			$data = $this->model_projects->getProjectData($id);
			echo json_encode($data);
		}

		return false;
	}

	/*
	* Its checks the Project form validation 
	* and if the validation is successfully then it inserts the data into the database 
	* and returns the json format operation messages
	*/
	public function create()
	{

		if(!in_array('createProject', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
		$this->form_validation->set_rules('project_name', 'Project Name', 'trim|required|is_unique[Projects.project_name]');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'project_name' => $this->input->post('project_name'),
        		'description' => $this->input->post('description'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->model_projects->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the Project information';			
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
	* Its checks the Project form validation 
	* and if the validation is successfully then it updates the data into the database 
	* and returns the json format operation messages
	*/
	public function update($id)
	{
		if(!in_array('updateProject', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {

			if(trim($this->input->post('edit_project_name')) != trim($this->input->post('old_project_name'))){
				$this->form_validation->set_rules('edit_project_name', 'Project Name', 'trim|required|is_unique[Projects.project_name]');
			} else {
				$this->form_validation->set_rules('edit_project_name', 'Project Name', 'trim|required');
			}
			$this->form_validation->set_rules('edit_description', 'Description', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'project_name' 	=> $this->input->post('edit_project_name'),
	        		'description' 	=> $this->input->post('edit_description'),
	        		'active' 		=> $this->input->post('edit_active'),	
	        	);

	        	$update = $this->model_projects->update($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the Project information';			
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
	* It removes the Project information from the database 
	* and returns the json format operation messages
	*/
	public function remove()
	{
		if(!in_array('deleteProject', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$id = $this->input->post('id');
		$response = array();
		if($id) {
			$delete = $this->model_projects->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the Project information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}