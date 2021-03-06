<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function __construct()
    {
       parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->session->unset_userdata('user');
        if(isset($this->session->user)){
           redirect(base_url('user'),'refresh');
        }else{
            redirect(base_url(),'refresh');
        }

    }

    public function index(){
       echo "Logging out....";
    }
}