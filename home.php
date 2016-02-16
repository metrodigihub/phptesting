
<?php
	class Users_model extends CI_Model {
		function __construct()  {
			parent::__construct();  
                        
                        //access default database
			$this->load->database('habitat');  
                        $this->load->database();
                        
                        //access the second database
//                        $admin_db= $this->load->database('db2');
//                        $this->load->database();
                        //$query = $admin_db->get('members');
                        //foreach ($query->result() as $row)
                        //echo $row->role;
                        
			}  
		public function get_all_users_habitat()  {
                    $query = $this->db->get('stage');  
                    return $query->result();  
		}  
//                public function get_all_users_metrodigi()  {
//			$query = $this->db2->get('stage');  
//			return $query->result();  
//		} 
	}  
        
?>

