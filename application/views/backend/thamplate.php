<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="<?php echo URL_ASSETS; ?>images/backend/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?php echo URL_ASSETS; ?>vendors/backend/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo URL_ASSETS; ?>vendors/backend/node-waves/waves.css" rel="stylesheet" />
    <link href="<?php echo URL_ASSETS; ?>vendors/backend/animate-css/animate.css" rel="stylesheet" />
    <link href="<?php echo URL_ASSETS; ?>vendors/backend/morrisjs/morris.css" rel="stylesheet" />
    <link href="<?php echo URL_ASSETS; ?>css/backend/style.css" rel="stylesheet">
    <link href="<?php echo URL_ASSETS; ?>css/backend/themes/all-themes.css" rel="stylesheet" />
    <link href="<?php echo URL_ASSETS; ?>vendors/dashboard/sweetalert/sweetalert.css" rel="stylesheet">
</head>

<body class="theme-red">

    <div class="overlay"></div>
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>

    <!-- Top Bar -->
    <?php $this->load->view("backend/page/header.php"); ?>

    <section>
        <!-- Left Sidebar -->        
        <?php $this->load->view("backend/page/sidebar.php"); ?>
    </section>

    <!-- Content -->    
    <?php $this->load->view($page); ?>

</body>
<div class="showcase sweet" style="display:none;"><a id="failed">.</a></div>
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