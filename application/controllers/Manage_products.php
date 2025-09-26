<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Products_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->data['products'] = $this->Products_model->get_all();
		$this->data['title'] = 'Product Management';
		$this->data['message'] = $this->session->flashdata('message');
		
		$this->load->view('manage_products', $this->data);
	}
	
	function add_product() {
		$this->data['title'] = 'Add Product';

		//validate form input
		$this->form_validation->set_rules('name', 'Product name', 'required|xss_clean');
		$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
		$this->form_validation->set_rules('price', 'Price', 'required|xss_clean');
		$this->form_validation->set_rules('picture', 'Picture', 'required|xss_clean');

		if ($this->form_validation->run() == true)
		{		
			$data = array(
				'name'				=> $this->input->post('name'),
				'description'		=> $this->input->post('description'),
				'price' 			=> $this->input->post('price'),
				'picture'  			=> $this->input->post('picture')
			);
			
			$this->Products_model->insert_product($data);
			
			$this->session->set_flashdata('message', "<p>Product added successfully.</p>");
			
			redirect(base_url().'manage');
		}else{
			//display the add product form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

			$this->data['name'] = array(
				'name'  	=> 'name',
				'id'    	=> 'name',
				'type'  	=> 'text',
				'style'		=> 'width:300px;',
				'value' 	=> $this->form_validation->set_value('name'),
			);			
			$this->data['description'] = array(
				'name'  	=> 'description',
				'id'    	=> 'description',
				'type'  	=> 'text',
				'cols'		=>	60,
				'rows'		=>	5,
				'value' 	=> $this->form_validation->set_value('description'),
			);
			$this->data['price'] = array(
				'name'  	=> 'price',
				'id'    	=> 'price',
				'type'  	=> 'text',
				'style'		=> 'width:40px;text-align: right',
				'value' 	=> $this->form_validation->set_value('price'),
			);
			$this->data['picture'] = array(
				'name'  => 'picture',
				'id'    => 'picture',
				'type'  => 'text',
				'style'	=> 'width:250px;',
				'value' => $this->form_validation->set_value('picture'),
			);
			
			$this->load->view('add_product', $this->data);
		}
	}

	function edit_product($product_id) {
		$product = $this->Products_model->get_product($product_id);

		$this->data['title'] = 'Edit Product';
	
		//validate form input
		$this->form_validation->set_rules('name', 'Product name', 'required|xss_clean');$this->form_validation->set_rules('description', 'Description', 'required|xss_clean');
		$this->form_validation->set_rules('price', 'Price', 'required|xss_clean');
		$this->form_validation->set_rules('picture', 'Picture', 'required|xss_clean');
	
		if (isset($_POST) && !empty($_POST))
		{		
			$data = array(
				'name'					=> $this->input->post('name'),
				'description'			=> $this->input->post('description'),
				'price' 				=> $this->input->post('price'),
				'picture' 				=> $this->input->post('picture'),
			);

			if ($this->form_validation->run() === true)
			{
				$this->Products_model->update_product($product_id, $data);

				$this->session->set_flashdata('message', "<p>Product updated successfully.</p>");
				
				redirect(base_url().'product/edit/'.$product_id);
			}			
		}

		$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		
		$this->data['product'] = $product;
		
		//display the edit product form
		$this->data['name'] = array(
			'name'  	=> 'name',
			'id'    	=> 'name',
			'type'  	=> 'text',
			'style'		=> 'width:300px;',
			'value' 	=> $this->form_validation->set_value('name', $product['name']),
		);
		
		$this->data['description'] = array(
			'name'  	=> 'description',
			'id'    	=> 'description',
			'type'  	=> 'text',
			'cols'		=>	60,
			'rows'		=>	5,
			'value' 	=> $this->form_validation->set_value('description', $product['description']),
		);

		$this->data['price'] = array(
			'name'  	=> 'price',
			'id'    	=> 'price',
			'type'  	=> 'text',
			'style'		=> 'width:40px;text-align: right',
			'value' 	=> $this->form_validation->set_value('price', $product['price']),
		);
	
		$this->data['picture'] = array(
			'name'  => 'picture',
			'id'    => 'picture',
			'type'  => 'text',
			'style'	=> 'width:250px;',
			'value' => $this->form_validation->set_value('picture', $product['picture']),
		);

		$this->load->view('edit_product', $this->data);
	}	
	
	function delete_product($product_id) {
		$this->Products_model->del_product($product_id);
		
		$this->session->set_flashdata('message', '<p>Product were successfully deleted!</p>');
		
		redirect('manage');
	}
}