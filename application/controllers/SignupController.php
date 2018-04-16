<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignupController extends CI_Controller
{

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

    public function index()
    {
        $data['content'] = $this->load->view('welcome/signup', [], true);
        $this->load->view('includes/index', $data);
    }

    public function storeNewUser()
    {

     try{
         $this->load->dbforge();
         $this->dbforge->add_field('id');
         $attributes = array('ENGINE' => 'InnoDB');
         if (!$this->db->table_exists('users')) {
             $user = array(
                 'name' => array(
                     'type' => 'VARCHAR',
                     'constraint' => 30,
                 ),
                 'email' => array(
                     'type' => 'VARCHAR',
                     'constraint' => 30,
                 ),
                 'password' => array(
                     'type' => 'VARCHAR',
                     'constraint' => 200,
                 )

             );

             $this->dbforge->add_field($user)->create_table('users', FALSE, $attributes);
         }

         $data=array(
             'name'=>$_POST['name'],
             'email'=>$_POST['email'],
             'password'=>md5($_POST['password'])
         );

         $this->db->insert('users',$data);
         if($this->db->affected_rows() != 1){
             $json=array('status'=>0,"message"=>"Some problem in signing up.");
         }else{
             $this->session->set_userdata('user', $_POST['email']);
             $json=array('status'=>1,'message'=>"Your are signed up. Redirecting...");
         }

     }catch (Exception $e){
          $json=array('status'=>-1,"message"=>$e.log_message());
    }

    echo json_encode($json);
    }
}