<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        if($this->session->user){
            redirect(base_url('user'));
        }
    }

    public function index(){

	    $data['content']=$this->load->view('welcome/welcome', [] ,true);
		$this->load->view('includes/index',$data);
	}

}
