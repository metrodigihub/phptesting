

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>CI CRUD</title>
                           
                     
        <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>-->         
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
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
        <h2 align="center" style="color: blue"></h2>
                  
     <section>
         <br>
        <ul class="tabs">
          <li><a href="#tab1"></a></li>
          <li><a href="#tab2">USERINFORMATION</a></li>
          <li><a href="#tab3">ABOUT</a></li>
        </ul>
        
        <section class="block">
            <article id="tab1">
                <br>
                
            </article>
         </section>
      </section>
            
        <script>
 
        </script>
	</body>
</html>


