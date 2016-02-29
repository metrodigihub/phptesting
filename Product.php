
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CI CRUD</title>
                           
                     
        <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>-->         
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
     
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/angular.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/jquery.dataTables.min.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/datatableuser.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/datatableuserinfo.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/angularjsondatatableuser.js" ></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/datatable/angularjsondatatableuserinfo.js" ></script>
        
        <?php echo link_tag('assets/css/datatable/jquery.dataTables.min.css')?>
        <?php echo link_tag('assets/css/tabs.css')?>
                
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
  
        <script>
            $(function(){
                $('ul.tabs li:first').addClass('active');
                $('.block article').hide();
                $('.block article:first').show();
                $('ul.tabs li').on('click',function(){
                $('ul.tabs li').removeClass('active');
                $(this).addClass('active');
                $('.block article').hide();
                var activeTab = $(this).find('a').attr('href');
                $(activeTab).show();
                return false;
              });
          });
         
        </script>
  
       
                
	</head>
    <body ng-app="HabitatApp">
        <h2 align="center" style="color: blue">Tracking System</h2>
                  
     <section>
         <br>
        <ul class="tabs">
          <li><a href="#tab1">HABITAT</a></li>
          <li><a href="#tab2">USERINFO</a></li>
          <li><a href="#tab3">ABOUT</a></li>
        </ul>
        
        <section class="block">
            <article id="tab1">
                <br>
                <br>
              <div ng-controller="HabitatCtrl">                   
               <table id="tablehabitatuser" align="center" class="display">
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>ISNO</th>
                              <th>ISBN</th>
                              <th>Stage</th>
                              <th>isbnfolder</th>
                              <th>tocexcel</th>
                              <th>eisbn</th>
                              <th>booktitle</th>
                              <th>last_accessed</th>
                          </tr>
                      </thead>
                        <tbody>                     
                         e</th>                              
                          </tr>
                      </thead>
                        <tbody>   
                            <tr style="font-size:10pt;" ng-repeat="habitatuser in habitatuserinfolist">
                                <td>
                                    {{ habitatuser.id }}
                                </td>
                                <td>
                                    {{ habitatuser.isno }}
                                </td>
                                  <td>
                                    {{ habitatuser.isbn }}
                                </td>
                                <td>
                                    {{ habitatuser.datetime }}
                                </td>                                  
                            </tr>                      
                      </tbody>

                </table>
              </div>   
            </article>
            <article id="tab3">

            </article>
         </section>
      </section>
            
        <script>
 
//        angular.module('HabitatApp', [])
//            .controller('HabitatCtrl', function ($scope, $http, $location) {
//                $scope.habitatlist=[];               
//                // $scope.myUrl = $location.absUrl();
//                $http({
//                    method: 'POST',
//                    url: '/CIDB/index.php/users/GetUsers'
//                  }).then(function successCallback(response) {
//                        
//                            $scope.habitatlist=angular.fromJson(response.data.habitat_user_list);
//                       
//                      // this callback will be called asynchronously
//                      // when the response is available
//                    }, function errorCallback(response) {
//                      // called asynchronously if an error occurs
//                      // or server returns response with an error status.
//                 });   
//
//            });


        </script>
	</body>
</html>
