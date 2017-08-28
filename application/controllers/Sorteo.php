<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sorteo extends CI_Controller {
	
    function sorteo()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
        $this->load->helper('html');
        $this->load->model('sorteo_model','',TRUE);
        $this->load->model('session_model','',TRUE);
        $this->load->library(array('table','pagination','session'));
	}
    
    function index(){
        $data=array();
        $data["action"]=site_url("sorteo/save_cuadro");
        $this->load->view('header',$data);
        $this->load->view('SORTEO/view1',$data);
        $this->load->view('footer',$data);
    }
    function save_cuadro(){
        $val=$this->sorteo_model->save1();
        return;	
    }
    function view2(){
        $data=array();
        $this->db->where('id',$this->uri->segment(3));
        $qry=$this->db->get($this->sorteo_model->tbl_cuadro);
        $dta=$qry->row();
        $this->db->where('idcuadro',$this->uri->segment(3));
        $qry1=$this->db->get($this->sorteo_model->tbl_equipo);
        $dta1=$qry1->result_array();
        $this->db->where('idcuadro',$this->uri->segment(3));
        $qry2=$this->db->get($this->sorteo_model->tbl_jugador);
        $dta2=$qry2->result_array();
        
        //echo $this->db->last_query();
        
        $htmlequipos='';
        for($i=0;$i<$qry2->num_rows();$i++){
            
            $htmlequipos.='<div class="form-group">
                        <label class="col-sm-2 control-label" style="padding-top: 0" for="formGroupInputLarge">Nombre de equipo:</label>
                        <div class="col-sm-4">
                            <input class="form-control" onchange="savedata(this.id)" value="'.$dta1[$i]['name'].'" autocomplete="off"  onkeypress="" type="text" id="equipo_'.$dta1[$i]['id'].'" maxlength="10" name="equipo[]" />
                        <span class="cobligatorio">*</span>
                        <div class="divlabelerr"><label id="elequipo_'.$dta1[$i]['id'].'" class="lblmjerror2" style="display: none;"></label></div>
                        </div>
                        <label class="col-sm-2 control-label" style="padding-top: 0" for="formGroupInputLarge">Nombre de Jugador:</label>
                        <div class="col-sm-4">
                            <input class="form-control" onchange="savedata(this.id)" value="'.$dta2[$i]['name'].'" autocomplete="off"  onkeypress="" type="text" id="jugador_'.$dta1[$i]['id'].'" maxlength="10" name="juagador[]" />
                        <span class="cobligatorio">*</span>
                        <div class="divlabelerr"><label id="eljugador_'.$dta1[$i]['id'].'" class="lblmjerror2" style="display: none;"></label></div>
                        </div>
                    </div>';
        }
        $data['dta']=$dta;
        $data["htmleq"]=$htmlequipos;
        $data["action"]=site_url("planillaje/save_crear_match");
        $this->load->view('header',$data);
        $this->load->view('SORTEO/view2',$data);
        $this->load->view('footer',$data);
    }
    
    function formartbequipos(){
        $val=$this->sorteo_model->formartbequipos();
        return;	
    }
    
    function mezclarequipos(){ 
        $val=$this->sorteo_model->mezclarequipos();
        return;	
    }
    function crearpartidos(){
        $val=$this->sorteo_model->crearpartidos();
        return;
    }
    function savedata(){ 
        $val=$this->sorteo_model->savedata();
        return;	
    }
}