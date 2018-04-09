<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Shop_model');
	}

	public function index()
	{
		$data['product'] = $this->Shop_model->get_all_parfume()->result();
		$this->load->view('shop_index', $data, FALSE);
	}

	public function add_queue(){
		$product = $this->input->post('product');
		$member = $this->input->post('member');
		$month = $this->input->post('month');
		$queue = $this->input->post('month');

		$month = date("Y-m-d",mktime(0,0,0,date("m")+$month,01,date("Y")));

		$q = $this->db->query("insert into cart_tmp (member, product, date, queue) values ('".$member."','".$product."','".$month."', ".$queue.")");
		if ($q) {
			echo true;
		} else {
			echo false;
		}
		
	}

	public function remove_queue($id){
		$this->db->where('id', $id);
		$this->db->delete('cart_tmp'); 
		redirect('Shop','refresh');
	}


}

/* End of file Shop.php */
/* Location: ./application/controllers/Shop.php */