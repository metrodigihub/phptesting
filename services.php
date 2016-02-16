<script>
 
        angular.module('HabitatApp', [])
            .controller('HabitatCtrl', function ($scope,$http) {
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
            });

        </script>
        
        
sub _convert_cals_table {
	my $cnt = shift;
	my $para_clean_flag = shift;
	
	my $namespace = "";
	$namespace = shift if(defined($_[0]) and $_[0] !~ m{^\s*$});
	
	my $cols_count = 0;
	
	# Simple clean valign="top" and width="..."
	#$cnt =~ s{ valign="top"}{}ig;
	$cnt =~ s{(<(?:tr|t[dh])(?: [^>]*)?) width="[^">]*"}{$1}ig;
	
	# Find column count
	if($cnt =~ m{^(?:(?!</?tr[ >]).)*(<tr[ >](?:(?!</?tr[ >]).)*</tr>)}is) {
		$cols_count = _column_count_table($1);
	}

	# Colgroup
	my $colspec_cnt = qq(<tgroup cols="$cols_count">\n);
	for(my $i=1;$i<=$cols_count;$i++) {
		$colspec_cnt .= qq(<colspec colnum="$i" colname="C$i" colwidth="*"/>\n);
	}
	$cnt =~ s{<table( [^>]*)>}{<table$1>\n$colspec_cnt}i;
	$cnt =~ s{</table>}{</tgroup>\n</table>}ig;

	# Spans and Colname
	$cnt =~ s{(<thead(?: [^>]*)?>)\s*((?:(?!</?thead[ >]).)*)\s*(</thead>)}{qq($1\n)._conver_morerows_namest($2).qq(\n</thead>)}ise;
	$cnt =~ s{(<tbody(?: [^>]*)?>)\s*((?:(?!</?tbody[ >]).)*)\s*</tbody>}{qq($1\n)._conver_morerows_namest($2).qq(\n</tbody>)}ise;
	
	# Tag change
	$cnt =~ s{(<(t[hd])(?: [^>]+)?>)\s*<p>((?:(?!</?p>).)*)</p>\s*</\2>}{$1$3</$2>}isg if($para_clean_flag =~ m{^(?:1|true)$}i);
	$cnt =~ s{<t[dh]([ >])}{<entry$1}ig;
	$cnt =~ s{</t[dh]>}{</entry>}ig;
	$cnt =~ s{(</?)tr(?=[ >])}{$1row}ig;
	$cnt =~ s{[\n\r][\n\r]+}{\n}g;
	$cnt =~ s{(<entry(?: [^>]+)?) align="justify"}{$1 align="left"}ig;
	
	# Namespace change
	$cnt =~ s/(<\/?)(table|tgroup|colspec|thead|tbody|row|entry)(?=[ >])/$1$namespace\:$2/ig if($namespace ne "");
	$cnt =~ s/(<\/?)table([ >])/$1table1$2/gi;
		
	return $cnt;
}

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
