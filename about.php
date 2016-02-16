
    <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
    class Users extends CI_Controller {  
            function __construct()  {  
                    parent::__construct();  
                    #$this->load->helper('url');  
                    $this->load->model('users_model');  
            }  
            public function index()  {  
                    $data['habitat_user_list'] = $this->users_model->get_all_users_habitat();
                    $this->load->view('show_users', $data); 

    //                $data['metrodigi_user_list'] = $this->users_model->get_all_users_metrodigi();  
    //		$this->load->view('show_users', $data);
            } 
            public function GetUsers()  {  
                    $data['habitat_user_list'] = $this->users_model->get_all_users_habitat();  
                    //$this->load->view('show_users', $data); 
                    $this->output->set_header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($data);

    //                $this->output->set_output($data);
    //                $this->response = json_encode($data);
                    //$data['metrodigi_user_list'] = $this->metrodigi_users_model->get_all_users_metrodigi();  
                    //$this->load->view('show_users', $data);
            } 

    }
