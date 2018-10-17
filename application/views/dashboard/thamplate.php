<!DOCTYPE html>
<html lang="en">

<head>    
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<title><?php echo $title; ?></title>
<link rel="icon" href="<?php echo URL_ASSETS; ?>images/backend/favicon.ico" type="image/x-icon">

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo URL_ASSETS; ?>css/dashboard/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/plugins.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo URL_ASSETS; ?>css/dashboard/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo URL_ASSETS; ?>css/dashboard/about.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/pricing.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/profile.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/error.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/todo.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo URL_ASSETS; ?>css/dashboard/layout.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/light2.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="<?php echo URL_ASSETS; ?>css/dashboard/custom.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo URL_ASSETS; ?>vendors/dashboard/sweetalert/sweetalert.css" rel="stylesheet">
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white page-sidebar-closed">
<div class="page-wrapper">
    
    <!-- content -->
    <?php $this->load->view($page); ?>
                      
    <div class="page-footer">
        <div class="page-footer-inner">
        2018 &copy; made with <i class="fa fa-heart" aria-hidden="true"></i> in
          <a href="#">Tangerang</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>        
</div>

</body>
<div class="showcase sweet" style="display:none;"><a id="failed">.</a></div>

<script src="<?php echo URL_ASSETS; ?>js/dashboard/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/clockface.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/app.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/layout.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/demo.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/quick-nav.min.js" type="text/javascript"></script>
<script src="<?php echo URL_ASSETS; ?>js/dashboard/bootstrap-confirmation.min.js" type="text/javascript"></script> 
<script src="<?php echo URL_ASSETS; ?>vendors/dashboard/sweetalert/sweetalert-dev.js"></script>
<?php if($this->session->flashdata('success')){ ?>
<script>
  $(document).ready(function(e){
      $('#failed').click();
  });
  document.querySelector('.showcase.sweet a').onclick = function(){
  swal("Congratulations...", "<?php echo $this->session->flashdata('success')?>", "success");
  };
</script>
<?php } if($this->session->flashdata('warning')) { ?>
<script>
  $(document).ready(function(e){
      $('#failed').click();
  });
  document.querySelector('.showcase.sweet a').onclick = function(){
  swal("Oops...", "<?php echo $this->session->flashdata('warning')?>", "error");
  };
</script>
<?php } ?>

</html>