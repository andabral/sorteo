
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