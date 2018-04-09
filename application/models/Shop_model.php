<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	
	 public function get_all_parfume(){
        $this->db->select('*');
        $this->db->from('product p');
        $this->db->join('product_brand b', 'p.brand=b.id');
        return $this->db->get();
    }

}

/* End of file Shop_model.php */
/* Location: ./application/models/Shop_model.php */