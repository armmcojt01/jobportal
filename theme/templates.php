<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ARMMC Online Recruitment System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">
    

    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/animate.css">
    
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/aos.css">

    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/ionicons.min.css">

    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>plugins/jobportal/css/style.css"> 
    <style type="text/css">
      /*  Header
==================================== */
.topbar{
  background-color: #37393c;
  padding: 5px 0;
  /* color:#fff; */
  font-size: 11px !important;
}
/*.topbar .container .row {
    margin: 0;
  padding:0;
}
.topbar .container .row .col-md-12 { 
  padding:0;
}
.topbar p{
  margin:0;
  display:inline-block;
  font-size: 11px;
  color: #f1f6ff;
}
.topbar p > i{
  margin-right:5px;
  color: #00bcd4;
}
.topbar p:last-child{
  text-align:right;
} 
 */

    </style>

     <?php if (isset($_SESSION['APPLICANTID'])) { ?> 
                <?php

                    $sql = "SELECT count(*) as 'COUNTNOTIF' FROM `tbljob` ORDER BY `DATEPOSTED` DESC";
                    $mydb->setQuery($sql);
                    $showNotif = $mydb->loadSingleResult();
                    $notif =isset($showNotif->COUNTNOTIF) ? $showNotif->COUNTNOTIF : 0;

                    $applicant = new Applicants();
                    $appl  = $applicant->single_applicant($_SESSION['APPLICANTID']);

                    $sql ="SELECT count(*) as 'COUNT' FROM `tbljobregistration` WHERE `PENDINGAPPLICATION`=0 AND `HVIEW`=0 AND `APPLICANTID`='{$appl->APPLICANTID}'";
                    $mydb->setQuery($sql);
                    $showMsg = $mydb->loadSingleResult();
                    $msg =isset($showMsg->COUNT) ? $showMsg->COUNT : 0;

                   ?> 
          <?php } ?>
  </head>
  <body>
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="<?php echo web_root; ?>">ARMMC Online Recruitment System</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item <?php  if(!isset($_GET['q'])) {  echo 'active';}  ?>"><a href="<?php echo web_root; ?>" class="nav-link">Home</a></li> 
            <li class="nav-item <?php  if(isset($_GET['q'])) { if($_GET['q']=='hiring'){ echo 'active'; }else{ echo ''; }} ?>"><a  class="nav-link" href="<?php echo web_root; ?>index.php?q=hiring">Job Vacancy</a></li>
            <li class="nav-item <?php  if(isset($_GET['q'])) { if($_GET['q']=='About'){ echo 'active'; }else{ echo ''; }}  ?>"><a  class="nav-link" href="<?php echo web_root; ?>index.php?q=About">About Us</a></li>
            <li class="nav-item <?php  if(isset($_GET['q'])) { if($_GET['q']=='Contact'){ echo 'active'; }else{ echo ''; }}  ?>"><a  class="nav-link" href="<?php echo web_root; ?>index.php?q=Contact">Contact</a></li>
            <?php if (!isset($_SESSION['APPLICANTID'])) { ?>
             <li   class="nav-item login"><a class="nav-link" data-target="#myModal" data-toggle="modal" href=""> <i class="fa fa-lock"></i> Login </a>
             </li>
             
             <?php }else{ ?>

              <li class="nav-item"><a class="nav-link" href="<?php echo web_root.'applicant/';?>"><i class="fa fa-user"></i> Mabuhay, <?php echo $appl->FNAME. ' '.$appl->LNAME ;?></a></li>

              <li class="nav-item"><a class="nav-link" href="<?php echo web_root.'logout.php';?>"><i class="fa fa-user"></i> Logout</a></li>
             <?php } ?> 
	          <li class="nav-item cta cta-colored"><a href="<?php echo web_root; ?>" class="nav-link">Want a Job</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

      <?php
    if (!isset($_SESSION['APPLICANTID'])) { 
      include("login.php");
    }
  ?>
    <?php require_once($content);?>


  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/popper.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/bootstrap.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.easing.1.3.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.stellar.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/owl.carousel.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/aos.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.animateNumber.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/jquery.timepicker.min.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/google-map.js"></script>
  <script src="<?php echo web_root; ?>plugins/jobportal/js/main.js"></script>
    <script type="text/javascript">
   
     $(function () {
    $("#dash-table").DataTable();
    $('#dash-table2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });


     $("#btnlogin").click(function(){
        var username = document.getElementById("user_email");
        var pass = document.getElementById("user_pass");

        // alert(username.value)
        // alert(pass.value)
        if(username.value=="" && pass.value==""){   
          $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
          $("#loginerrormessage").html("Invalid Username and Password!");
          //  $("#loginerrormessage").css(function(){ 
          //   "background-color" : "red";
          // });
        }else{

          $.ajax({    //create an ajax request to load_page.php
              type:"POST",  
              url: "process.php?action=login",    
              dataType: "text",  //expect html to be returned  
              data:{USERNAME:username.value,PASS:pass.value},               
              success: function(data){   
                // alert(data);
                $('#loginerrormessage').fadeOut(); 
                $('#loginerrormessage').fadeIn();  
                $('#loginerrormessage').css({ 
                        "background" :"red",
                        "color"      : "#fff",
                        "padding"    : "5px;"
                    }); 
               $('#loginerrormessage').html(data);   
              } 
              }); 
          }
        });


$('input[data-mask]').each(function() {
  var input = $(this);
  input.setMask(input.data('mask'));
});


$('#BIRTHDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});
$('#HIREDDATE').inputmask({
  mask: "2/1/y",
  placeholder: "mm/dd/yyyy",
  alias: "date",
  hourFormat: "24"
});

$('.date_picker').datetimepicker({
  format: 'mm/dd/yyyy',
  startDate : '01/01/1950', 
  language:  'en',
  weekStart: 1,
  todayBtn:  1,
  autoclose: 1,
  todayHighlight: 1, 
  startView: 2,
  minView: 2,
  forceParse: 0 

});
 </script>
  </body>
</html>