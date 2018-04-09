<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Shop extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('front/Order_model','order_model');
		$this->load->model('front/Product_model','product_model');
		$this->load->model('admin/Category_model','category_model');
		$this->load->model('front/Traffic_model','traffic_model');
		$this->load->model('front/Banner_model','banner_model');
		$this->load->library('cart');
		$this->load->library('user_agent');
        // $this->record_traffic();
	}
	
	public function index()
	{	
		$data['products'] = $this->product_model->get_all();
		$data['banners'] = $this->banner_model->get_all();
		$data['categories'] = $this->category_model->get_all();
		$this->load->template_front("front/shop_home", $data);
	}
	
	function add()
	{
		$img = $this->product_model->getProductImageById($this->input->post('id'));
		$qty = 1;
		if ($jumlah = $this->input->post('qty')) {
			$qty = $jumlah;
		}
		
      	// Set array for send data.
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'qty' => $qty,
			'disc' => $this->input->post('discount'),
			'img' => $img->picture
		);		

                 // This function add items into cart.
		$this->cart->insert($insert_data);
	      
                // This will show insert data in cart.
		redirect('shop');
	}
	
	function remove($rowid) {
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($data);
		}
		
                 // This will show cancle data in cart.
		redirect('shop');
	}
	
	function update_cart(){
                
                // Recieve post values,calcute them and update
        $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
                    
    		$data = array(
				'rowid'   => $rowid,
                'price'   => $price,
                'amount'  =>  $amount,
				'qty'     => $qty
			);
             
			$this->cart->update($data);
		}

		$redi = base_url().$_POST['this_uri'];

		redirect($redi);
	}

    function checkout_form(){
        // Load "billing_view".
    	if (empty($this->cart->contents())) {
    		redirect(base_url().'shop');
    	}else{
    		$this->load->template_front("front/checkout_form");
    	}
    }
        
    public function complete_order()
	{

		$name = xss_clean($this->input->post('name'));
		$metode_pembayaran = xss_clean($this->input->post('metode_pembayaran'));
		$phone = xss_clean($this->input->post('phone'));
		$address = xss_clean($this->input->post('address'));
		$email = xss_clean($this->input->post('email'));
		$booking_code = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10));
		$tgl = date('Y-m-d H:i:s');

		if ( empty($name) && empty($metode_pembayaran) && empty($phone) && empty($address) ) {
			redirect(base_url().'shop');
		}elseif (empty($this->cart->contents())) {
			redirect(base_url().'shop');
		}

		// vdebug($this->cart->contents());
		// return $this->test_email_template($name,$metode_pembayaran,$booking_code,$tgl,$this->cart->contents());
		// die();

     	// This will store all values which inserted  from user.
		$customer = array(
			'name' 		=> $name,
			'email' 	=> $email,
			'address' 	=> $address,
			'phone' 	=> $phone
		);		

         // And store user imformation in database.
		$cust_id = $this->order_model->insert_customer($customer);

		$order = array(
			'kode_booking'	=> $booking_code,
			'date' 			=> $tgl,
			'customer_id' 	=> $cust_id,
			'lokasi_toko' 	=>'Semarang',
			'metode_pembayaran'	=> $metode_pembayaran,
			'status'		=> 0
		);		

		$ord_id = $this->order_model->insert_order($order);
		
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'order_id' 		=> $ord_id,
					'product_id' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'discount'		=> $item['disc']
				);		

                // Insert product imformation with order detail, store in cart also store in database. 
		         $cust_id = $this->order_model->insert_order_detail($order_detail);
		         $this->product_model->update_stock($item['id'],$item['qty']);
			endforeach;
		endif;

		$data['customer'] 	 = $name;
		$data['booking_code'] = $booking_code;

		// vdebug($email)
		if ($email != "") {
			
			$send = $this->mail_customer($email,$name,$metode_pembayaran,$booking_code,$tgl,$this->cart->contents());
			if ($send) {
				$this->cart->destroy();
				$this->load->template_front('front/checkout_success',$data);
			}else{
				echo 'Mailer to Customer Error..';
			}
		}else{	
		  $this->cart->destroy();
	        // After storing all imformation in database load "billing_success".
	      return $this->load->template_front('front/checkout_success',$data);
	      // vdebug(data);
		}



	}

	public function search()
	{
		$search = $this->input->post('search');
		$category = $this->input->post('cat');
		if ($search || $category) {
			$result = $this->product_model->getProductBySearch($category,$search);
			echo json_encode($result);
		}else{
			$result = $this->product_model->get_all();
			echo json_encode($result);
		}
		
	}

	public function product($slug)
	{
		$data['product'] = $this->product_model->getProductBySlug($slug);
		$data['categories'] = $this->category_model->get_all();
		$this->load->template_front('front/product',$data);
	}

	function mail_customer($to_mail,$name,$metode_pembayaran,$booking_code,$tgl,$cart)
	{
        $this->load->library('email');
        
        $config['protocol']    = 'smtp';
        
        $config['smtp_host']    = 'mail.iwakmart.com';
        
        $config['smtp_port']    = '465';
        
        $config['smtp_timeout'] = '7';
        
        $config['smtp_user']    = 'arief@iwakmart.com';
        
        $config['smtp_pass']    = 'oke124567';
        
        $config['smtp_crypto']    = 'ssl';
        
        $config['charset']    = 'utf-8';
        
        $config['newline']    = "\r\n";
        
        $config['mailtype'] = 'html'; // or html
        
        $config['validation'] = TRUE; // bool whether to validate email or not      
        
        $this->email->initialize($config);
        
        $data['name'] 		= $name;
        $data['payment'] 	= $metode_pembayaran;
        $data['booking_code'] = $booking_code;
        $data['items']	= $cart;
        $data['tgl_trx']	= $tgl;
        
        $message = $this->load->view('email_template/sec12', $data, TRUE);

        $this->email->from('arief@iwakmart.com', 'iwakmart');
        $this->email->to($to_mail); 
        
        $this->email->subject('Order Berhasil Dilakukan');

        $this->email->message($message);  
        
        $sent = $this->email->send();
        if ($sent) {
        	return true;
        }else{
        	return false;
        }
        
	}

	function record_traffic(){

		$page = $this->input->post('page_visited');

		$ref = '';
		if ($this->agent->is_referral()) {
			$ref	= $_SERVER['HTTP_REFERER'];
		}
		
		$agent		= $this->agent->agent_string();
		$ip			= $this->getUserIP();
		$host_name	= gethostbyaddr($_SERVER['REMOTE_ADDR']);

		if ($page == '') {
			$data = array(
				'time' 			=> date('Y-m-d H:i:s'),
				'http_referer' 	=> $ref,
				'user_agent' 	=> $agent,
				'ip_address'	=> $ip,
				'host_name'		=> $host_name
			);
		}else{
			$data = array(
				'time' 			=> date('Y-m-d H:i:s'),
				'http_referer' 	=> $ref,
				'user_agent' 	=> $agent,
				'ip_address'	=> $ip,
				'host_name'		=> $host_name,
				'page_visited' => $page
			);
		}

		$rec = $this->traffic_model->record($data);

		if ($rec) {
			echo "sukses";
		}else{
			echo "gagal ".$rec;
		}
		
	}

	function getUserIP()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}

	public function destroy_record_traffic(){
		$unset = $this->session->unset_userdata('record_traffic');
		if ($unset) {
			echo "sukses unset";
		}else{
			echo "error unset";
		}
	}

	public function test_email_template($name='',$metode_pembayaran='',$booking_code='',$tgl='',$cart=[]){

		$data['name'] 		= $name;
      $data['payment'] 	= $metode_pembayaran;
      $data['booking_code'] = $booking_code;
      $data['items']	= $cart;
      $data['tgl_trx']	= $tgl;
        
      $this->load->view('email_template/sec12', $data);
      // die();
	}

	public function check_availability(){
		$cart = $this->cart->contents();
		// vdebug($cart);
		$res = false;
		$not_available = array();
		$i = 0;
		foreach ($cart as $item) {
			$product = $this->product_model->getProductById($item['id']);

			if ($item['qty'] > $product['stock']) {
				
				$sisa = 'Tersisa '.$product['stock'].' '.$product['satuan'];
				if ($product['stock'] < 1) {
					$sisa = 'Stock Kosong';
				}

				$not_available[$i] = array(
					'id' => $item['id'],
					'text' => 'Stock Produk <b>'.$item['name'].'</b> tidak dapat mencukupi permintaan',
					'sisa_stock' => $sisa,
				);
				$i++;
				$res = false;
			}
		}
				// echo '<pre>' . var_dump($not_available);

		echo json_encode($not_available);

	}

}