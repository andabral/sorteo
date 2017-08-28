/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var xmlHttp1
var xmlHttp2

function getLiquidaciones(codLiquidador){
    xmlHttp1 = new XMLHttpRequest();
    if(xmlHttp1 == null){
        alert("No soporta AJAX!!!")
        return;
    }
    var url = "combLiquidaciones.jsp";
    url = url + "?&codLiquidador=" + codLiquidador;
    xmlHttp1.onreadystatechange = resultado_select;
    xmlHttp1.open("GET",url,true);
    xmlHttp1.send(null);
}

function resultado_select(){
    if(xmlHttp1.readyState == 4){
        document.getElementById("cmbLiquidacion").innerHTML = xmlHttp1.responseText;
    }
}


function getLiquidadores(tipoLiquidador){
    xmlHttp2 = new XMLHttpRequest();
    if(xmlHttp2 == null){
        alert("No soporta AJAX!!!")
        return;
    }
    var url = "combLiquidadores.jsp";
    url = url + "?&tipoLiquidador=" + tipoLiquidador;
    xmlHttp2.onreadystatechange = resultado_select_liquidadores;
    xmlHttp2.open("GET",url,true);
    xmlHttp2.send(null);
}

function resultado_select_liquidadores(){
    if(xmlHttp2.readyState == 4){
        document.getElementById("cmbLiquidador").innerHTML = xmlHttp2.responseText;
    }
}