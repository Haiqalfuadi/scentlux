<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function validasi_login($email,$password){
        $this->db->select('*');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $query = $this->db->get('member');
        $data = $query->row();
        if($query->num_rows()>0){
            $user_data = array(
                'id_member' => $data->id,
                'email' => $email,
                'is_login' => true,
                'name' => $data->name,
                'cart' => $this->get_cart($data->id)
            );
            // echo "<pre>";
            // print_r ($this->get_cart($data->id));
            // die();
            $this->session->set_userdata($user_data);
            echo "<pre>";
            print_r ($this->session->userdata['cart']);
            die();
            return true;
        }else{
            return false;
        }
    }

public function get_cart($id){
    $this->db->select('*');
    $this->db->from('cart_tmp c');
    $this->db->join('product p', 'p.id=c.product');
    $this->db->where('member',$id);
    return $this->db->get()->result_array();
}

}

/* End of file Member_model.php */
/* Location: ./application/models/Member_model.php */