<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge;"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>SORTEO</title>
    <!-- Bootstrap core CSS -->
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.css" type="text/css"/>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>    
    <script type="text/javascript" src="<?php echo base_url(); ?>/js/ajax.js" ></script>
        
    <!-- Bootstrap core JS -->
    <!--script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script-->
    <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/modal.js"></script>
    
    <!-- Los calendarios -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/calendar/calendar.css" type="text/css"/>
    <script type="text/javascript">var rutacalimg = '<?php echo base_url(); ?>';</script>
    <script src="<?php echo base_url(); ?>js/calendar/calendar.js" language="JavaScript1.2" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/calendar/inireport.js" language="JavaScript1.2" type="text/javascript"></script>
    
    <?php
    $perfil=$this->session->userdata('usuario_perfil');
    if(isset($perfil)&&!empty($perfil)){$perfil=$perfil;}else{$perfil='';}
    ?>
    <script type="text/javascript">
    
    function salir(){
        document.location = '<?php echo site_url();?>/login/salir'; 
    }
    function home(){
        document.location = '<?php echo site_url();?>/login/menu_principal'; 
    }
    
    </script>