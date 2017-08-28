<?php
class sorteo_model extends CI_Model
{		
		var $tbl_cuadro= 'cuadro';
        var $tbl_equipo= 'equipo';
        var $tbl_jugador= 'jugador';
        var $tbl_partido= 'partido';
        var $tbl_equipojugador = 'equipo_jugador';
        function sorteo_model()
		{
			  //$this->load->library('email'); 
		}
        
        function save1(){
            $nequipos=$this->input->post('nequipos');
            $data = array(
					'nequipos' => $nequipos,
					'fregistro' => date("Y-m-d H:i:s"),
			);
            $this->db->insert($this->tbl_cuadro, $data);
            $idcab=$this->db->insert_id();
            
            $htmlequipos='';
            for($i=0;$i<$nequipos;$i++){
                $data1 = array(
    					'idcuadro' => $idcab,
    					'fregistro' => date("Y-m-d H:i:s"),
    			);
                $this->db->insert($this->tbl_equipo, $data1);
                $idequipo=$this->db->insert_id();
                $this->db->insert($this->tbl_jugador, $data1);
                $idjugador=$this->db->insert_id();
                
            }
            redirect("sorteo/view2/$idcab");return;
            
            //rhuerta@grupo-link.com
            //jmoran@grupo-link.com
            //redirect("sorteo/view2");
        }
        
        function formartbequipos(){
            $nequipos=$this->input->post('nequipos');
            $htmlequipos='';
            for($i=0;$i<$nequipos;$i++){
                
                $htmlequipos.='<div class="form-group">
                            <label class="col-sm-2 control-label" style="padding-top: 0" for="formGroupInputLarge">Nombre de equipo:</label>
                            <div class="col-sm-4">
                                <input class="form-control" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="equipo[]" />
                            <span class="cobligatorio">*</span>
                            <div class="divlabelerr"><label id="elnequipos" class="lblmjerror2" style="display: none;"></label></div>
                            </div>
                            <label class="col-sm-2 control-label" style="padding-top: 0" for="formGroupInputLarge">Nombre de Jugador:</label>
                            <div class="col-sm-4">
                                <input class="form-control" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="juagador[]" />
                            <span class="cobligatorio">*</span>
                            <div class="divlabelerr"><label id="elnequipos" class="lblmjerror2" style="display: none;"></label></div>
                            </div>
                        </div>';
            }
            echo $htmlequipos;
        }
        
         
    	function mezclarequipos(){
    	    $parametros=$_POST;
            $keys= array_keys($parametros);
            for($i=0; $i<count($keys); $i++):						$$keys[$i]= $parametros[$keys[$i]];
            endfor;
            
            /*$this->db->where('id',$idcuadro);
            $qry=$this->db->get($this->tbl_cuadro);
            $dta=$qry->row();*/
            $this->db->where('idcuadro',$idcuadro);
            $qry1=$this->db->get($this->tbl_equipo);
            $dta1=$qry1->result_array();
            $this->db->where('idcuadro',$idcuadro);
            $qry2=$this->db->get($this->tbl_jugador);
            $dta2=$qry2->result_array();
            $htmlequipos='';
            for($i=0;$i<$nequipos;$i++){
                $aryequipo[] = $dta1[$i]['id'];
                $arynameequipo[$dta1[$i]['id']]=$dta1[$i]['name'];
                $aryjugador[] = $dta2[$i]['id'];
                $arynamejugador[$dta2[$i]['id']]=$dta2[$i]['name'];
            }
            //print_r($aryequipo);echo "<br/>";
            //print_r($aryjugador);echo "<br/>";
            shuffle($aryequipo);
            shuffle($aryjugador);
            //print_r($aryequipo);echo "<br/>";
            //print_r($aryjugador);
            //return;
            $this->db->where('idcuadro',$idcuadro);
            $this->db->delete($this->tbl_equipojugador);
            for($i=0;$i<$nequipos;$i++){
                $savedata = array(
    					'idcuadro' => $idcuadro,
                        'idequipo' => $aryequipo[$i],
                        'idjugador' => $aryjugador[$i],
    					'fregistro' => date("Y-m-d H:i:s"),
    			);
                $this->db->insert($this->tbl_equipojugador, $savedata);
                $htmlequipos.='<div class="form-group">
                            <div class="col-sm-3">
                                <input readonly="true" class="form-control" value="'.$arynameequipo[$aryequipo[$i]].'" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="equipo[]" />
                            </div>
                            <div class="col-sm-3">
                                <input readonly="true" class="form-control" value="'.$arynamejugador[$aryjugador[$i]].'" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="juagador[]" />
                            </div>
                        </div>
                        ';
            }
            $htmlequipos.='<hr style="margin-top: 0;" />
                        <div class="divrinp" style="text-align:left">
                          <input id="btnsaveform" class="btn btn-primary btn-lg" onclick="crearpartidos();" type="button" value="CREAR PARTIDOS"/>
                        </div>';
            echo $htmlequipos;
        }
        
        function crearpartidos(){
            $idcuadro=$this->uri->segment(3);
            
            $this->db->where('idcuadro',$idcuadro);
            //EQUIPOS
            $qry0=$this->db->get($this->tbl_equipo);
            $dta0=$qry0->result_array();
            //JUGADORES
            $this->db->where('idcuadro',$idcuadro);
            $qry2=$this->db->get($this->tbl_jugador);
            $dta2=$qry2->result_array();
            
            $this->db->where('idcuadro',$idcuadro);
            $qry1=$this->db->get($this->tbl_equipojugador);
            $dta1=$qry1->result_array();
            
            $npar=count($dta1)/2;
            shuffle($dta1);
            
            $el1=array_pop($dta1);
            
            shuffle($dta1);
            
            $el2=array_pop($dta1);
            
            shuffle($dta1);
            if(is_null($el1)|| is_null($el2)){return;}
            $htmlequipos='';
            $this->db->where('idcuadro',$idcuadro);
            $this->db->delete($this->tbl_partido);
            do{
                
                $savedata = array(
    					'idcuadro' => $idcuadro,
                        'idequipojugador1' => $el1['id'],
                        'idequipojugador2' => $el2['id'],
    					'fregistro' => date("Y-m-d H:i:s"),
    			);
                $this->db->insert($this->tbl_partido, $savedata);
                for($i=0;$i<$qry0->num_rows();$i++){
                    if($dta0[$i]["id"]==$el1['idequipo']){$nameequipo1= $dta0[$i]["name"];}
                }
                for($i=0;$i<$qry2->num_rows();$i++){
                    if($dta2[$i]["id"]==$el1['idjugador']){$namejugador1= $dta2[$i]["name"];}
                }
                for($i=0;$i<$qry0->num_rows();$i++){
                    if($dta0[$i]["id"]==$el2['idequipo']){$nameequipo2= $dta0[$i]["name"];}
                }
                for($i=0;$i<$qry2->num_rows();$i++){
                    if($dta2[$i]["id"]==$el2['idjugador']){$namejugador2= $dta2[$i]["name"];}
                }
                $htmlequipos.='<div class="row">
                            <div class="col-sm-3">
                                <input readonly="true" class="form-control" value="'.$nameequipo1." - ".$namejugador1.'" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="equipo[]" />
                            </div>
                            <div class="col-sm-3">
                                 VS 
                            </div>
                            <div class="col-sm-3">
                                <input readonly="true" class="form-control" value="'.$nameequipo2." - ".$namejugador2.'" onchange="" autocomplete="off"  onkeypress="" type="text" id="nequipos" maxlength="10" name="juagador[]" />
                            </div>
                        </div>
                        ';
                
                $el1=array_pop($dta1);
                shuffle($dta1);
                $el2=array_pop($dta1);
                shuffle($dta1);    
            }while(!is_null($el1)&& !is_null($el2));
            
            echo $htmlequipos;
            
        }
        
        function savedata(){
            $id=$this->input->post('id');
            $val=$this->input->post('valor');
            $campo=$this->input->post('campo');
            if($campo=='equipo'){
                $this->db->where('id',$id);
                $data = array(
    					'name' => $val,
    					'fregistro' => date("Y-m-d H:i:s"),
    			);
                $this->db->update($this->tbl_equipo, $data);
                
            }else if($campo=='jugador'){
                $this->db->where('id',$id);
                $data = array(
    					'name' => $val,
    					'fregistro' => date("Y-m-d H:i:s"),
    			);
                $this->db->update($this->tbl_jugador, $data);
            }
            
        }
        
        
}

?>