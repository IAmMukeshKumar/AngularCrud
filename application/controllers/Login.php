<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();
        if($this->session->user){
            redirect(base_url('user'));
        }
    }

    public function index(){
        $data['content'] = $this->load->view('welcome/login', [] ,true);
        $this->load->view('includes/index', $data);
    }

    public function grantLogin(){
      $ifGrant=$this->db->select('*')->where(array('email'=>'admin@admin.com'))->from('users')->get()->result()[0];
      if(!empty($ifGrant)){
          $this->session->set_userdata(array('userName'=>$ifGrant->name,'user'=>$ifGrant->email));
          $json=array('status'=>1,'message'=>"This user is not valid.");

      }else{
          $json=array('status'=>0,'message'=>"This user is not valid.");
      }
       echo json_encode($json);
    }
}
