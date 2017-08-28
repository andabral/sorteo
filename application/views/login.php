<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
	<title>CZS5::</title>
	<link href="<?php echo base_url();?>images/MSP2.png" rel="shortcut icon"/>


    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" type="text/css"/>

    <!-- Custom styles for this template -->
    <style type="text/css">
    
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #222;
    }
    
    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
        
    #autlegenda{
    	font-family: sans-serif;
    	/*color:rgb(31, 141, 206);*/
    	font-size: 70%;
    	text-align: center;
    	color: silver;
    }
    
    .mensaje{
        color: red;
    }
    
    </style>

   

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
	  <?php echo form_open('login/index','class="form-signin" role="form"');?>
      
      	<div style="text-align: center">
			<img src="<?php echo base_url(); ?>images/logo3.png" border="0" title=""/>
            <label class="mensaje"><?php if(isset($mensaje)&&$mensaje!=''){ echo $mensaje;}?></label>
		</div>
        
        <!-- h2 class="form-signin-heading" style="text-align: center;color: white;">Login</h2-->
        <p id="autlegenda">
			Si Usted es un usuario de nuestros Servicios Online <br/>
			ingrese como habitualmente lo ha realizado,ingresando <br/>
			su usuario y clave.
		</p>
        <input type="text" class="form-control" placeholder="Usuario" id="inpusuario" name="inpusuario" required autofocus>
        <input type="password" class="form-control" placeholder="Clave" id="inpclave" name="inpclave" required>
        <div class="form-group">
          <a href="<?php echo site_url('login/forgot_passwd');?>" class="text-warning" style="float: left;" >Recordar contrase&ntilde;a</a>
          <a href="<?php echo site_url('login/signup');?>" class="text-success" style="float: right;" >Registrarse</a>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
