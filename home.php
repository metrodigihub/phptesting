
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
			vangular.module('HabitatApp', [])
        .controller('HabitatCtrl', function ($scope, $http) {
            $scope.habitatlist=[];             
            $http({
                method: 'POST',
                url: '/CIDB/index.php/users/GetUsers'
              }).then(function successCallback(response) {
                        $scope.habitatlist=angular.fromJson(response.data.habitat_user_list);
                  // this callback will be called asynchronously
                  // when the response is available
                }, function errorCallback(response) {
                  // called asynchronously if an error occurs
                  // or server returns response with an error status.
             });   

           })

     
            .controller('HabitatUserCtrl', function ($scope, $http){
                $scope.habitatuserinfolist = [];       
                $http({
                    method: 'POST',
                    url: '/CIDB/index.php/users/GetUsersInfo'                
                    }).then(function successCallback(response){
                       $scope.habitatuserinfolist = angular.fromJson(response.data.habitat_user_info_list); 
                    }, function errorCallback(response){
                     // called asynchronously if an error occurs
                      // or server returns response with an error status.
                });            
            });  
			
=head3 _get_table_colspec

	This is the method used to get colspec text of the table.

	Function Name  : _get_table_colspec(<tablefirstrowcontent>)
	Arguments      : Arg1 => Table with content
	Return         : Colgroup(Colspec) content
	Usage          : my $count = _get_table_colspec($tablecnt);

=cut

sub _get_table_colspec {
	my $cnt = shift;
	my $cols_count = 0;
	
	# Find column count
	if($cnt =~ m{^(?:(?!</?tr[ >]).)*(<tr[ >](?:(?!</?tr[ >]).)*</tr>)}is) {
		$cols_count = _column_count_table($1);
	}

	# Colgroup
	my $colspec_cnt = qq(<tgroups cols="$cols_count">\n);
	for(my $i=1;$i<=$cols_count;$i++) {
		$colspec_cnt .= qq(<colspec colnum="$i" colname="C$i" colwidth="*"/>\n);
	}
	$colspec_cnt .= qq(</tgroups>);
	
	return $colspec_cnt;
}
#=====================================================
			
			
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

