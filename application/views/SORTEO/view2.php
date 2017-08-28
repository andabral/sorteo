
    <script type="text/javascript">
        function check_onlyNumber(evt)
        {
            evt = (evt) ? evt : event ;
            var key = (evt.which) ? evt.which : evt.keyCode;
            var p =0;
            
            // NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57, '.' = 46
            //if (key >= 48 && key <= 57 || key == 8 || key ==46)
            if (key >= 48 && key <= 57 || key <= 13 || key ==39)
            return true;
            else
            return false;
        }
        function check_onlyLetter(e){
        
            tecla = (document.all) ? e.keyCode : e.which; // 2
        
            if (tecla==8||tecla==0) return true; // 3
        
            patron =/[A-Za-z\s]/; // 4
        
            te = String.fromCharCode(tecla); // 5
        
            return patron.test(te); // 6
        
        }
        

        function trim (myString)
        {
            return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
        }
        
        function mostrarmensaje(idobj,mensaje){
        	var divid="el"+idobj;
        	document.getElementById(divid).innerHTML =mensaje;
        	document.getElementById(divid).style.display = "";
        	document.getElementById(idobj).style.backgroundColor='#F1AEF9';
            document.getElementById(idobj).focus();
        }
        function ocultarmensaje(idobj){
        	var divid="el"+idobj;
        	document.getElementById(divid).innerHTML ="";
        	document.getElementById(divid).style.display = "none";
        	document.getElementById(idobj).style.backgroundColor='';
        }
        
        function guardarform(){
        	v=validarform();
        	//v=0;
        	if(v){
        		btng=document.getElementById("formce");
        		btng.setAttribute("type", "submit");
        		btng.submit();
        	}else{
        		alert("Revise y llene todos los campos correctamente");
        	}
        } 
        
        function validarform(){
            if(!(document.getElementById("nequipos").value%2 == 0)){
                mostrarmensaje("nequipos","El numero debe ser par");
                return false;
            }else{
            	ocultarmensaje("nequipos");
            }
            return false;
        }
        
        
        
        function isAlphaNumeric(e)
        {
        	  var k;
              document.all ? k=e.keycode : k=e.which;
              return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0|| k == 8);
           
        }
        
        function getXMLHTTPRequest()
        { 
            var xmlhttp=false;
        	try{
        		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        	}catch(e)
        	{
        		try{
        			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");		// Creacion del objet AJAX para IE
        		}catch(E){
        			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
        		}
        	}
        	return xmlhttp; 
        }
        
        
        function check_onlyAlphaNum(e){
        
            tecla = (document.all) ? e.keyCode : e.which; // 2
        
            if (tecla==8||tecla==0) return true; // 3
        
            patron =/[0-9A-Za-z-\s\:\,\.\u00D1\u00F1\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FA\u00DC\u00FC\?]/; // 4
            
            te = String.fromCharCode(tecla); // 5
            
            return patron.test(te); // 6
        
        }
        
        function right(e) {
              var msg = "Prohibido usar Click Derecho !!! ";
              if (navigator.appName == 'Netscape' && e.which == 3) {
                 alert(msg); //- Si no quieres asustar a tu usuario entonces quita esta linea...
                 return false;
              }
              else if (navigator.appName == 'Microsoft Internet Explorer' && event.button==2) {
                 alert(msg); //- Si no quieres asustar al usuario que utiliza IE,  entonces quita esta linea...
                                //- Aunque realmente se lo merezca...
                 return false;
              }
           return true;
        }
        
        function keydisable(e) {
            //key=ctrlkey   :ctrl
            //key=86    :v
            //key=67    :c
            var key;      
            if(window.event)
                key = window.event.keyCode; //IE
            else
                key = e.which; //firefox
            
            return !((e.ctrlKey && (key==86 || key==67))|| key==13)
        }
        
        function mezclar(){
        	//v=validarcampos();
            v=1;
        	if(v){
        		var frm=document.getElementById("formce");
                var postData='';
                for (var j = 0; j < frm.length; j++){
                    postData += frm[j].id + "=" + document.getElementById(frm[j].id).value + (i<frm.length-1?"&":"");
                }
                //return;
                var xhr=getXMLHTTPRequest();
                var direccion = '<?php echo site_url('sorteo/mezclarequipos'); ?>';
            	xhr.open("POST",direccion,false);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
        		xhr.onreadystatechange=function(){
                    try 
                    {
            			if(xhr.readyState == 4){
                	        if(xhr.status==200){
                                document.getElementById("divtbequipos").innerHTML=xhr.responseText;
                                return true;
                	        }else if(xhr.status==404){
                	           alert("Page not found");
                               return false;
                	        }
            	    	}
                     }catch(e){
                        alert("Error: "+e.message);  
                     }
                }
            	xhr.send(postData);
            
        	}else{
        		alert("Revise y llene todos los campos correctamente");
        	}
        }
        
        function crearpartidos(){
    		var xhr=getXMLHTTPRequest();
            var direccion = '<?php echo site_url('sorteo/crearpartidos/'.$dta->id); ?>';
        	xhr.open("GET",direccion,false);
            xhr.onreadystatechange=function(){
                try 
                {
        			if(xhr.readyState == 4){
            	        if(xhr.status==200){
                            document.getElementById("divtbpartidos").innerHTML=xhr.responseText;
                            return true;
            	        }else if(xhr.status==404){
            	           alert("Page not found");
                           return false;
            	        }
        	    	}
                 }catch(e){
                    alert("Error: "+e.message);  
                 }
            }
        	xhr.send();
        
        }  
        
        function validarcampos(){
            if(!(document.getElementById("nequipos").value%2 == 0)){
                mostrarmensaje("nequipos","El numero debe ser par");
                return false;
            }else{
            	ocultarmensaje("nequipos");
            }
            return true;
        }
        
        function savedata(id){
            aray=id.split("_");
    		var el=document.getElementById(id);
            var postData='id='+aray[1]+"&campo="+aray[0]+"&valor="+el.value;
            var xhr=getXMLHTTPRequest();
            var direccion = '<?php echo site_url('sorteo/savedata'); ?>';
        	xhr.open("POST",direccion,false);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=ISO-8859-1');
    		xhr.onreadystatechange=function(){
                try 
                {
        			if(xhr.readyState == 4){
            	        if(xhr.status==200){
                            //document.getElementById("divtbequipos").innerHTML=xhr.responseText;
                            return true;
            	        }else if(xhr.status==404){
            	           alert("Page not found");
                           return false;
            	        }
        	    	}
                 }catch(e){
                    alert("Error: "+e.message);  
                 }
            }
        	xhr.send(postData);
        
    	}
    </script>    
  </head>

  <body >
  

<style type="text/css">
        body {
            font-family: Helvetica,Arial,sans-serif;
            //font-size: 1.5em;
            padding-top: 70px;
            margin: 0;
            padding: 0;
            text-align:center;
            background-color: black;
            vertical-align: middle;
        }
        
        #logosalud{
        	height:100px;
        	background-color: black;	
        }
        #homelogin{
        	margin:2% auto;
        	text-align: center;
        	display: inline-block;
        	//vertical-align:top;
        	padding:0.5em;
        	//width: 70%;
        	background-color:white;
        	border-radius:.5em;
        	max-width: 75%;
        	width: 100%;
        }
        
        #autlegenda{
        	font-family: sans-serif;
        	/*color:rgb(31, 141, 206);*/
        	font-size: 60%;
        	opacity:0.7;
        }
        .autlegenda{
        	font-family: sans-serif;
        	/*color:rgb(31, 141, 206);*/
        	font-size: 60%;
        	opacity:0.7;
        }
        .divlabelerr{
        	max-width:100%;
        }
        div.divlabelerr{
        	text-align:left;
        	padding: 0;
        	vertical-align: middle;
        	position: absolute;
        }
        .lblmjerror2{
            font-weight: bold;
            color: red;
            font-size: xx-small;
        }    
        .cobligatorio{
            position: absolute;
        	font-weight: bold;
            color: red;
            font-size: small;
            left: 0;
            top: 0;
        }
        @media(max-width:900px){
        	#wrapper {
        		max-width: 100%;
        	    max-height:100%;
        	}
            div.divlabelerr{
        		vertical-align: middle;
        		text-align:center;
        		position: static;
        	}
        	#login div{
        		padding: 0em
        	}
        	#homelogin{
        		display: block;
        		width: 99%;
        	}
        	.divcinp, .divrinp{
        		display: block;
        	}
        	.divcinp, .divclabel{
        		max-width:100%;
        		width: 100%;
        		display: inline-block;
        	}
        }

    </style> 
   
		<div class="panel panel-default" id="homelogin">
    	<div class="panel-heading" style="padding-left:0;padding-right: 0;">
            <div class="panel-title title">
                <h1><?php echo $dta->nequipos;?> EQUIPOS</h1>
            </div>
            </div>
            <a id="yourLinkID" href="#homelogin" style="display: none;"></a>
    		<hr style="border-style: dashed;margin: 0;"/>
    		<div class="panel-body">
                <form id="formce" class="form-horizontal" enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
                    <input type="hidden" id="idcuadro" name="idcuadro" value="<?php echo $dta->id?>"/>
                    <input type="hidden" id="nequipos" name="nequipos" value="<?php echo $dta->nequipos?>"/>
                    <hr style="margin-top: 0;" />
                    <?echo $htmleq;?>
                    <hr style="margin-top: 0;" />
                    <div class="divrinp" style="text-align: left;">
                      <input id="btnsaveform" class="btn btn-primary btn-lg" onclick="mezclar();" type="button" value="MEZCLAR"/>
                      <!--input id="btnsaveform" class="btn btn-danger btn-lg" onclick=" document.location = '<?php echo site_url("soporte/missoportes")?>'" type="button" value="CANCELAR"/-->
                    </div>
                    <hr />
                    <div id="divtbequipos"></div>
                    <hr/>
                    <div id="divtbpartidos"></div>
    			</form>
    		<hr/>
    		
    	</div>
        </div>
      </div>
      
    </div>
    
    
   	<style type="text/css">
    
        #myModal2 table tr.trcargos:hover{
            cursor: pointer;
        }
        #myModal2 table tr.trcargos:hover td.tdcargo{
            background-color: #46b8da;
            color:white;
        }
        
        #myModal3 table tr.trcargos:hover{
            cursor: pointer;
        }
        #myModal3 table tr.trcargos:hover td.tdcargo{
            background-color: #46b8da;
            color:white;
        }
    </style>
    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
    <script>//settipo();
    <?php //if(isset($update)){if($update==1){echo "settab2('blue');";}else if($update==2){echo "settab2('black');";}}?>
    </script>