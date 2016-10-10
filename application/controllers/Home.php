<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Home extends Secure_Controller 
{
	public function __construct()
	{
		parent::__construct();	

    	$batch_save_data = array (
			'receipt_show_taxes' => $this->Appconfig->get('receipt_show_taxes'),
			'receipt_show_total_discount' => $this->Appconfig->get('receipt_show_total_discount'),
			'receipt_show_date' => $this->Appconfig->get('receipt_show_date'),
			'receipt_show_employee_name' => $this->Appconfig->get('receipt_show_employee_name'),
			'receipt_show_seller_address' => $this->Appconfig->get('receipt_show_seller_address'),
			'receipt_show_seller_phone_number' => $this->Appconfig->get('receipt_show_seller_phone_number'),
			'receipt_show_serialnumber' => $this->Appconfig->get('receipt_show_serialnumber'),
			'receipt_set_thank_you_message' => $this->Appconfig->get('receipt_set_thank_you_message')
		);
		$this->session->set_userdata($batch_save_data);
	}

	public function index()
	{

		$this->load->view('home');

	}

	public function logout()
	{
		$this->Employee->logout();

		if($this->config->item('statistics') == TRUE)
		{
			$this->load->library('tracking_lib');

			$this->tracking_lib->track_page('Logout', 'logout');
		}
	}
}
?>