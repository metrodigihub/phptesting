
//    angular.module('HApp', [])
//            .controller('UserCtrl', function ($scope, $http){
//                $scope.userinfolist = [];       
//                $http({
//                    method: 'POST',
//                    url: '/CIDB/index.php/users/GetUsersInfo'                
//                    }).then(function successCallback(response){
//                       $scope.userinfolist = angular.fromJson(response.data._user_info_list); 
//                    }, function errorCallback(response){
//                     // called asynchronously if an error occurs
//                      // or server returns response with an error status.
//                });            
//            }); 



sub _conver_morerows_namest {
	my $cnt = shift;
	my %dummy_rowcol = ();
	my $out_cnt = "";
	
	my $cur_row = 0;	
	while($cnt =~ m{(<tr(?: [^>]*)?>)((?:(?!</?tr[ >]).)*)</tr>}isg) {
		$cur_row++;
		$out_cnt .= qq(\n$1);
		
		my $crow_txt = $2;
		
		my $cur_col = 0;
		while($crow_txt =~ m{<t[hd](?: [^>]*)?>(?:(?!</?t[hd][ >]).)*</t[hd]>}isg) {
			$cur_col++;
			my $ccol_txt = $&;

			$cur_col++ while(exists $dummy_rowcol{qq($cur_row##$cur_col)});
			$ccol_txt =~ s{(<t[dh])([ >])}{$1 colno="$cur_col"$2}i;

			if($ccol_txt =~ m{ rowspan="([0-9]+)"[^>]* colspan="([0-9]+)"}i) {
				for(my $j=$cur_col+1;$j <= $cur_col+$2-1; $j++) {
					$dummy_rowcol{qq($cur_row##$j)}="";
				}
			
				for(my $i=$cur_row + 1;$i < $cur_row+$1; $i++) {
					for(my $j=$cur_col;$j <= $cur_col+$2-1; $j++) {
						$dummy_rowcol{qq($i##$j)}="";
					}
				}
				$cur_col += $2-1;
			}
			elsif($ccol_txt =~ m{ rowspan="([0-9]+)"}i) {
				for(my $i=$cur_row + 1;$i < $cur_row+$1; $i++) {
						$dummy_rowcol{qq($i##$cur_col)}="";
				}
			}
			elsif($ccol_txt =~ m{ colspan="([0-9]+)"}i) {
				for(my $j=$cur_col+1;$j <= $cur_col+$1-1; $j++) {
					$dummy_rowcol{qq($cur_row##$j)}="";
				}
				$cur_col += $1-1;
			}

			$out_cnt .= qq(\n$ccol_txt);
		}
		$out_cnt .= qq(\n</tr>);
	}

	$out_cnt =~ s{ rowspan="([0-9]+)"}{qq( morerows=").($1-1).qq(")}ige;
	$out_cnt =~ s{ colno="([0-9]+)"([^>]* )colspan="([0-9]+)"}{qq($2namest="C$1" nameend="C).($1+$3-1).qq(")}ige;
	$out_cnt =~ s{ colno="}{ colname="C}ig;
	$out_cnt =~ s{( colname="[^"]*"[^>]*)( morerows="[^"]*")}{$2$1}ig;
	
	return $out_cnt;
}
