<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->database();

         if(!isset($this->session->user)){
             redirect(base_url());
         }
    }
    public function index(){
        $data['content']=$this->load->view('user/dashboard',[],true);
        $this->load->view('includes/index',$data);
    }

    public function retrieveAllUsers(){

        $email=$this->session->user;
        $users=$this->db->select('*')->from('users')->where('email!=',$email)->get()->result();
        $json=array('status'=>1,'message'=>'All users','users'=>$users);
        echo json_encode($json);
    }

    public function delete($id){
      $ifUser=$this->db->select('id')->from('users')->where('id=',$id)->get()->num_rows();
     if($ifUser){
           $isDeleted=$this->db->where('id', $id)->delete('users');
           $json=array('isDeleted'=>$isDeleted,'message'=>"One user was deleted");
     }else{
         $json=array("isDeleted"=>"No","message"=>"This user can not be deleted");
     }
      echo json_encode($json);
    }

    public function viewUser($id){
        $ifUser=$this->db->select('*')->from('users')->where('id=',$id)->get();
        if($ifUser->num_rows()){
            $user=$ifUser->result();
            $json=array("userCount"=>$ifUser->num_rows(),'user'=>$user);
        }else{
            $json=array('userCount'=>$ifUser->num_rows(),'message'=>"No user found");
        }

        echo json_encode($json);
    }

    public function updateUser($id){
        $ifUser=$this->db->select('*')->from('users')->where('id=',$id)->get()->num_rows();
        if($ifUser){
            $this->db->where('id',$id)->update('users',array('name'=>$_POST['name']));
            $json=array('affectedRows'=>$this->db->affected_rows(),'message'=>"User was updated successfully");
        }else{
            $json=array('message'=>"User can not be updated");
        }

      echo json_encode($json);
    }

}