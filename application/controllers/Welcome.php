<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function get_image($photo)
	{
		$code= str_replace(['zop','zox'],['+','/'],$photo);
		$src = $this->encryption->decrypt($code);
		$filename="assets/images/".$src.".png";
		$mime = mime_content_type($filename);
		header('Content-Length: '.filesize($filename));
		header("Content-Type: $mime");
		header('Content-Disposition: inline; filename="'.$filename.'";');
		readfile($filename);
		die();
	}

	public function checkCard(){
		header('Content-Type: application/json');
		$response = [];
		$encrypt_1 =  $this->encryption->decrypt($_POST['encrypt_1']);
		$encrypt_2 = $this->encryption->decrypt($_POST['encrypt_2']);
		if($encrypt_1 == $encrypt_2){
			$response['status'] = 'success';
		}
		else {
			$response['status'] = 'false';
		}

		echo json_encode($response);
	}
}
