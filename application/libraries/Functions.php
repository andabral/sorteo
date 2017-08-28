<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|-------------------------------------------------------------------------
| Code Igniter Functions Class Version 1.0
| Functionality is several functinos like Get Number of Week 
|
| Copyright (C) 2010 
| Website: http://erp_grupo_sv.com
|-------------------------------------------------------------------------
| This library is free software; you can redistribute it and/or
| modify it under the terms of the GNU Lesser General Public
| License as published by the Free Software Foundation; either
| version 2.1 of the License, or (at your option) any later version.
| 
| This library is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
| Lesser General Public License for more details.
| 
| You should have received a copy of the GNU Lesser General Public
| License along with this library; if not, write to the Free Software
| Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
| 
| Last changed:
| 07 May '10 Rafael Rivadeneira, aconsigli at insistema dot com
|
*/

class Functions {

	function Functions()
	{
		 
	}
    
    /*  
        Semana considerada de Domingo a Sabado
        La primera semana del a�o en que contiene cuatro o m�s d�as de ese a�o.  
    */   
    function get_semanas($anio)
    {   
        if($anio>1998)
        while($anio>1998)
            $anio = $anio - 28;
        
        $semana_51 = array("1974","1985","1991","1996");
        $semana_52 = array("1970","1971","1973","1976","1977","1979","1981","1982","1983","1987","1988","1990","1993","1994","1998");
        $semana_53 = array("1972","1975","1978","1980","1984","1986","1989","1992","1995","1997");
        
        if (in_array($anio, $semana_51)) return 51;
        if (in_array($anio, $semana_52)) return 52;
        if (in_array($anio, $semana_53)) return 53;
            
        return 0;
    }
    
    function get_semana($fecha, $val = '')
    {
        $fecha = strtotime($fecha);
        if (!empty($val)) $fecha = strtotime($val,$fecha);  
        
        
        $anio = date("Y",$fecha);
        if($anio>1998) while($anio>1998) $anio = $anio - 28;
        if($anio<1970) while($anio<1970) $anio = $anio + 28;
            
        $fecha = strtotime($anio.'-'.date("m",$fecha).'-'.date("d",$fecha));
        if($fecha<$this->get_start_date($anio)) $anio = $anio - 1;
        
        $num_semanas = $this->get_semanas($anio);
        $fecha_inicio = $this->get_start_date($anio);
        
        for($semanas=1;$semanas!=$num_semanas+1;$semanas++)
        {
            if($fecha>=$fecha_inicio && $fecha<=strtotime('6 day',$fecha_inicio)) return $semanas;
            $fecha_inicio = strtotime('7 day',$fecha_inicio);
        }
        
        return 1;
    }


    function cleantmp() {
            $seconds_old = 3600;
            $directory = dirname(__FILE__)."/../../../charts";            

            if( !$dirhandle = @opendir($directory) )
                    return;

            while( false !== ($filename = readdir($dirhandle)) ) {
                    if( $filename != "." && $filename != ".." ) {
                            $filename = $directory. "/". $filename;

                            if( @filemtime($filename) < (time()-$seconds_old) )
                                    @unlink($filename);
                    }
            }
    }
    
    function get_month_name($num_mes, $short=FALSE)
    {
        $nombre_mes[] = Array("Ene","Feb","Mar","Abr","May","Jun","Jul",
                              "Ago","Sep","Oct","Nov","Dic");
        $nombre_mes[] = Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
                              "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $short = $short?0:1;
        return $nombre_mes[$short][$num_mes-1];    
    }
    
    function get_day_name($num_dia, $short=FALSE)
    {
        $nombre_dia[] = Array("D","L","M","Mi","J","V","S");
        $nombre_dia[] = Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
        
        $short = $short?0:1;
        return $nombre_dia[$short][$num_dia-1];    
    }
    
    function get_start_date($anio)
    {
        if($anio>1998) while($anio>1998) $anio = $anio - 28;
        if($anio<1970) while($anio<1970) $anio = $anio + 28;
            
        $anio_fecha = array(    // strtotime solo abarca de 1970 a 2036
                                //"1967" => strtotime('1967-01-01'),
                                //"1968" => strtotime('1967-12-31'),
                                //"1969" => strtotime('1968-12-29'),
                                "1970" => strtotime('1970-01-04'),
                                "1971" => strtotime('1971-01-03'),
                                "1972" => strtotime('1972-01-02'),
                                "1973" => strtotime('1972-12-31'),
                                "1974" => strtotime('1973-12-30'),
                                "1975" => strtotime('1974-12-29'),
                                "1976" => strtotime('1976-01-04'),
                                "1977" => strtotime('1977-01-02'),
                                "1978" => strtotime('1978-01-01'),
                                "1979" => strtotime('1978-12-31'),
                                "1980" => strtotime('1979-12-30'),
                                "1981" => strtotime('1981-01-04'),
                                "1982" => strtotime('1982-01-03'),
                                "1983" => strtotime('1983-01-02'),
                                "1984" => strtotime('1984-01-01'),
                                "1985" => strtotime('1984-12-30'),
                                "1986" => strtotime('1985-12-29'),
                                "1987" => strtotime('1987-01-04'),
                                "1988" => strtotime('1988-01-03'),
                                "1989" => strtotime('1989-01-01'),
                                "1990" => strtotime('1989-12-31'),
                                "1991" => strtotime('1990-12-30'),
                                "1992" => strtotime('1991-12-29'),
                                "1993" => strtotime('1993-01-03'),
                                "1994" => strtotime('1994-01-02'),
                                "1995" => strtotime('1995-01-01'),
                                "1996" => strtotime('1995-12-31'),
                                "1997" => strtotime('1996-12-29'),
                                "1998" => strtotime('1998-01-04'),
        );
     
        return $anio_fecha[$anio];   
    }
    
    function get_start_date_week($anio,$week)
    {    
        $start_date = $this->get_start_date($anio);
        $fecha_inicio = strtotime((($week-1)*7).' day',$start_date);
        return $anio.substr(date("Y-m-d",$fecha_inicio),4,6);
    }
    
    
    /**
     * Functions::get_object_to_table()
     * $header =>    $style[] = array("hectareas"=>array("style"=>"text-align:left;","formatter"=>"number"));
     * @return
     */
    function get_object_to_table_no_utf8($header=null,$data,$style=null,$filtro=null,$scollbars=false,$pointcoma=false)
    {
    	if ($data->num_rows() == 0) {
    		echo '<div style="text-align:center;">No se encontr&oacute; ning&uacute;n resultado bajo ese criterio de filtro.</div>';
    	} else {
    		if($scollbars) echo '<div style="overflow:scroll">';
    		echo '<table>';
    		//Setear Header
    		echo '<tr style="font-weight:bold;">';
    
    		$cabecera = array();
    		if(!empty($header)){
    			foreach($header as $campo){
    				echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.$campo.'</td>';
    				$cabecera[] = strtolower($campo);
    			}
    		}
    		 
    		if(empty($header)){
    			$fields = $data->field_data();
    			foreach ($fields as $field) {
    				echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.strtoupper(str_replace("_"," ",$field->name)).'</td>';
    				$cabecera[] = strtolower($field->name);
    			}
    		}
    		echo '</tr>';
    
    		//Setear contenido
    		foreach($data->result() as $row)
    		{
    			echo '<tr>';
    			$row_i = 0;
    			$marcar_fila = "";
    			foreach($row as $value)
    			{
    				echo '<td style="';
    				//Setea el Estilo
    				foreach($style as $st){
    					$cabecera_i = strtolower($cabecera[$row_i]);
    					$estilo = @$st[$cabecera_i]["style"];
    					$formato = @$st[$cabecera_i]["formatter"];
    					$negrilla = @$st[$cabecera_i]["negrilla"];
    
    					if($value==$negrilla && !empty($value)) $marcar_fila = @$st[$cabecera_i]["negrilla"];
    					if(!empty($marcar_fila)) echo "font-weight:bold;";
    					if (is_numeric(str_replace('""', '', $value)) && empty($formato)){
    						echo "text-align:right;";break;
    					}
    					echo $estilo;
    					if(!empty($formato)){
    						if ($formato=="string" || $formato=="text") {
    							if(empty($estilo)) echo "text-align:left;mso-number-format:\@;";break;
    						}
    						if ($formato=="percent2" || $formato=="percent2") {
    							if(empty($estilo)) echo "text-align:left;mso-number-format:Percent;";break;
    						}
    						if ($formato=="number" || $formato=="numeric") {
    							if(empty($estilo)) echo "text-align:right;";break;
    						}
    						if ($formato=="float" || $formato=="double") {
    							if(empty($estilo)) echo "text-align:right;";$value=number_format($value,2,',',"");break;
    						}
    						if ($formato=="float_1" || $formato=="double_1") {
    							if(empty($estilo)) echo "text-align:right;";$value=number_format($value,1,',',"");break;
    						}
    						if ($formato=="float_5" || $formato=="double_5") {
    							if(empty($estilo)) echo "text-align:right;";$value=number_format($value,5,',',"");break;
    						}
    						if ($formato=="currency" || $formato=="money") {
    							if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,2,',',"");break;
    						}
    						if ($formato=="currency_5" || $formato=="money_5") {
    							if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,5,',',"");break;
    						}
    						if ($formato=="percent") {
    							if(empty($estilo))echo "text-align:right;";$value=number_format($value,2,',',"")."%";break;
    						}
    					}
    				}
    				if (is_numeric(str_replace('""', '', $value)) && empty($style)){
    					echo "text-align:right;";break;
    				}
    				if ((is_numeric(str_replace('""', '', $value)) || is_numeric(str_replace('$', '', $value))) && $pointcoma) $value = str_replace('.', ',', $value);
    				$value=str_replace(PHP_EOL," ",$value);
    				echo '">'.str_replace("\\n"," ",$value).'</td>';
    				$row_i++;
    			}
    			echo '</tr>';
    		}
    		echo '</table>';
    		if($scollbars) echo '</div>';
    	}
    }
    /**
     * Functions::get_object_to_table()
     * $header =>    $style[] = array("hectareas"=>array("style"=>"text-align:left;","formatter"=>"number"));
     * @return
     */
    function get_object_to_table($header=null,$data,$style=null,$filtro=null,$scollbars=false,$pointcoma=false)
    {        
        if ($data->num_rows() == 0) {
            echo '<div style="text-align:center;">No se encontr&oacute; ning&uacute;n resultado bajo ese criterio de filtro.</div>';
        } else {
            if($scollbars) echo '<div style="overflow:scroll">';
            echo '<table>';
            //Setear Header
            echo '<tr style="font-weight:bold;">';
            
            $cabecera = array();
            if(!empty($header)){
                foreach($header as $campo){
                     echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.$campo.'</td>';
                     $cabecera[] = strtolower($campo);
                }
            }
                       
            if(empty($header)){       
                $fields = $data->field_data();  
                foreach ($fields as $field) {
                    echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.strtoupper(str_replace("_"," ",$field->name)).'</td>';
                    $cabecera[] = strtolower($field->name);
                }
            }
            echo '</tr>';
        
            //Setear contenido 
            foreach($data->result() as $row)
            {
                echo '<tr>';
                $row_i = 0;
                $marcar_fila = "";
                foreach($row as $value)
                {
                    echo '<td style="';
                    //Setea el Estilo
                    foreach($style as $st){
                        $cabecera_i = strtolower($cabecera[$row_i]);
                        $estilo = @$st[$cabecera_i]["style"];
                        $formato = @$st[$cabecera_i]["formatter"];
                        $negrilla = @$st[$cabecera_i]["negrilla"];
                        
                        if($value==$negrilla && !empty($value)) $marcar_fila = @$st[$cabecera_i]["negrilla"];
                        if(!empty($marcar_fila)) echo "font-weight:bold;";
                        if (is_numeric(str_replace('""', '', $value)) && empty($formato)){ echo "text-align:right;";break;}
                        echo $estilo;
                        if(!empty($formato)){
                            if ($formato=="string" || $formato=="text") {if(empty($estilo)) echo "text-align:left;mso-number-format:\@;";break;}
                            if ($formato=="percent2" || $formato=="percent2") {if(empty($estilo)) echo "text-align:left;mso-number-format:Percent;";break;}
                            if ($formato=="number" || $formato=="numeric") {if(empty($estilo)) echo "text-align:right;";break;}
                            if ($formato=="float" || $formato=="double") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,2,',',"");break;}
                            if ($formato=="float_1" || $formato=="double_1") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,1,',',"");break;}
                            if ($formato=="float_5" || $formato=="double_5") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,5,',',"");break;}
                            if ($formato=="currency" || $formato=="money") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,2,',',"");break;}
                            if ($formato=="currency_5" || $formato=="money_5") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,5,',',"");break;}
                            if ($formato=="percent") {if(empty($estilo))echo "text-align:right;";$value=number_format($value,2,',',"")."%";break;}
                        }
                    }
                    if (is_numeric(str_replace('""', '', $value)) && empty($style)){ echo "text-align:right;";break;}
                    if ((is_numeric(str_replace('""', '', $value)) || is_numeric(str_replace('$', '', $value))) && $pointcoma) $value = str_replace('.', ',', $value);
                    echo '">'.utf8_encode($value).'</td>';
                    $row_i++;
                }
                echo '</tr>';
            }
            echo '</table>';
            if($scollbars) echo '</div>';
        }
    }

    /**
     * Functions::get_array_to_table()
     * $header =>    $style[] = array("hectareas"=>array("style"=>"text-align:left;","formatter"=>"number"));
     * @return
     */
    function get_array_to_table($header=null,$array,$style=null,$filtro=null,$scollbars=false,$pointcoma=false)
    {
        if (count($array) == 0) {
            echo '<div style="text-align:center;">No se encontro ning&uacute;n resultado bajo ese criterio de filtro.</div>';
        } else {
            if($scollbars) echo '<div style="overflow:scroll">';
            echo '<table>';
            //Setear Header
            echo '<tr style="font-weight:bold;">';
            
            $cabecera = array();
            
            if(!empty($header)){            
                foreach($header as $campo){
                     echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.strtoupper(str_replace("_"," ",$campo)).'</td>';
                     $cabecera[] = strtolower($campo);
                }
            }            
            if(empty($header)){       
                $fields = $query->field_data();  
                foreach ($fields as $field) {
                    echo '<td>'.strtoupper(str_replace("_"," ",$field->name)).'</td>';
                    $cabecera[] = strtoupper(str_replace("_"," ",$field->name));
                }
            }            
            echo '</tr>';
            
            //Setear contenido 
            foreach($array as $row)
            {
                echo '<tr>';
                $row_i = 0;
                $marcar_fila = "";

                foreach($row as $key=>$value) 
                {
                    //echo $row_i;
                    echo '<td style="';
                    //Setea el Estilo
                    foreach($style as $st){
                        $cabecera_i = strtolower($cabecera[$row_i]);
                        $estilo = strtolower(@$st[$cabecera_i]["style"]);
                        $formato = @$st[$cabecera_i]["formatter"];
                        $negrilla = @$st[$cabecera_i]["negrilla"];
                        if($value==$negrilla && !empty($value)) $marcar_fila = @$st[$cabecera_i]["negrilla"];
                        if(!empty($marcar_fila)) echo "font-weight:bold;background-color:silver;";
                        if (is_numeric(str_replace('""', '', $value)) && empty($formato)){ echo "text-align:right;border:1px solid #DDDDDD;width:100px;";break;} //REPITE sino tiene estilo
                        echo $estilo;
                        
                        if(!empty($formato)){
                            if ($formato=="string" || $formato=="text") {if(empty($estilo)) echo "text-align:left;mso-number-format:\@;";break;}
                            if ($formato=="number" || $formato=="numeric") {if(empty($estilo)) echo "text-align:right;";break;}
                            if ($formato=="float" || $formato=="double") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,2,',',"");break;}
                            if ($formato=="float_1" || $formato=="double_1") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,1,',',"");break;}
                            if ($formato=="float_5" || $formato=="double_5") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,5,',',"");break;}
                            if ($formato=="currency" || $formato=="money") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,2,',',"");break;}
                            if ($formato=="currency_5" || $formato=="money_5") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,5,',',"");break;}
                            if ($formato=="percent") {if(empty($estilo))echo "text-align:right;";$value=$value."%";break;}
                        }
                        
                    }
                    if (is_numeric(str_replace('""', '', $value)) && empty($style)){ echo "text-align:right;border:1px solid #DDDDDD;";break;}
                    if ((is_numeric(str_replace('""', '', $value)) || is_numeric(str_replace('$', '', $value))) && $pointcoma) $value = str_replace('.', ',', $value);
                    echo '">'.$value.'</td>';
                    $row_i++;
                }
                echo '</tr>';
            }
            echo '</table>';
            if($scollbars) echo '</div>';
        }
    }

    
    function get_array_to_table_sum($header=null,$array,$style=null,$filtro=null,$scollbars=false,$pointcoma=false)
    {
        if (count($array) == 0) {
            echo '<div style="text-align:center;">No se encontro ning&uacute;n resultado bajo ese criterio de filtro.</div>';
        } else {
            if($scollbars) echo '<div style="overflow:scroll">';
            echo '<table>';
            //Setear Header
            echo '<tr style="font-weight:bold;">';
            
            $cabecera = array();
            
            if(!empty($header)){            
                foreach($header as $campo){
                     echo '<td style="background-color:silver;border:1px solid #DDDDDD">'.strtoupper(str_replace("_"," ",$campo)).'</td>';
                     $cabecera[] = strtolower($campo);
                }
            }            
            if(empty($header)){       
                $fields = $query->field_data();  
                foreach ($fields as $field) {
                    echo '<td>'.strtoupper(str_replace("_"," ",$field->name)).'</td>';
                    $cabecera[] = strtoupper(str_replace("_"," ",$field->name));
                }
            }            
            echo '</tr>';
            
            //Setear contenido 
            foreach($array as $row)
            {
                echo '<tr>';
                $row_i = 0;
                $marcar_fila = "";

                foreach($row as $key=>$value) 
                {
                    //echo $row_i;
                    echo '<td style="';
                    //Setea el Estilo
                    foreach($style as $st){
                        $cabecera_i = strtolower($cabecera[$row_i]);
                        $estilo = strtolower(@$st[$cabecera_i]["style"]);
                        $formato = @$st[$cabecera_i]["formatter"];
                        $negrilla = @$st[$cabecera_i]["negrilla"];
                        if($value==$negrilla && !empty($value)) $marcar_fila = @$st[$cabecera_i]["negrilla"];
                        if(!empty($marcar_fila)) echo "font-weight:bold;background-color:silver;";
                        if (is_numeric(str_replace('""', '', $value)) && empty($formato)){ echo "text-align:right;border:1px solid #DDDDDD;width:100px;";break;} //REPITE sino tiene estilo
                        echo $estilo;
                        
                        if(!empty($formato)){
                            if ($formato=="string" || $formato=="text") {if(empty($estilo)) echo "text-align:left;mso-number-format:\@;";break;}
                            if ($formato=="number" || $formato=="numeric") {if(empty($estilo)) echo "text-align:right;";break;}
                            if ($formato=="float" || $formato=="double") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,2,',',"");break;}
                            if ($formato=="float_1" || $formato=="double_1") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,1,',',"");break;}
                            if ($formato=="float_5" || $formato=="double_5") {if(empty($estilo)) echo "text-align:right;";$value=number_format($value,5,',',"");break;}
                            if ($formato=="currency" || $formato=="money") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,2,',',"");break;}
                            if ($formato=="currency_5" || $formato=="money_5") {if(empty($estilo))echo "text-align:right;";$value="$".number_format($value,5,',',"");break;}
                            if ($formato=="percent") {if(empty($estilo))echo "text-align:right;";$value=$value."%";break;}
                        }
                        
                    }
                    if (is_numeric(str_replace('""', '', $value)) && empty($style)){ echo "text-align:right;border:1px solid #DDDDDD;";break;}
                    if ((is_numeric(str_replace('""', '', $value)) || is_numeric(str_replace('$', '', $value))) && $pointcoma) $value = str_replace('.', ',', $value);
                    echo '">'.$value.'</td>';
                    $row_i++;
                }
                echo '</tr>';
            }
            echo '';
            if($scollbars) echo '';
        }
    }
    
    
     // Funcion de Objeto a Array
    function object_to_array($object)
    {
      if(is_array($object) || is_object($object))
      {
        $array = array();
        foreach($object as $key => $value)
        {
          $array[$key] = object_to_array($value);
        }
        return $array;
      }
      return $object;
    }
 
    // Funcion de Array a Objeto
    function array_to_object($array = array())
    {
    	return (object) $array;
    }        
    
    
    
    
    // Funcion Beta para obtener la semana
    function GetWeek($fechaBusqueda){
        $fechaBusqueda = strtotime($fechaBusqueda);
        $fecha = strtotime(date("Y",$fechaBusqueda).'-01-01');
        $fechaPrimerSabado = strtotime(date("Y",$fechaBusqueda).'-01-01');
        
        if(date("w",$fecha)!=0){
            for($i=1;$i<8;$i++){
                if(date("w",strtotime($i.' day',$fecha))==0){
                    //$fechaPrimerDiaSemana = strtotime(date("Y",strtotime($i ." day",$fecha))."-".date("m",strtotime($i ." day",$fecha))."-".date("d",strtotime($i . " day",$fecha)));
                    $fechaPrimerSabado = strtotime($i.' day',$fecha);
                    break;
                }
            }
        }
        
        $semana = 0;
        for($i=0;$i<54;$i++){
            if($fechaBusqueda>=strtotime(($i*7) . ' day',$fechaPrimerSabado) && $fechaBusqueda<strtotime((($i*7)+7) . ' day',$fechaPrimerSabado)){
                $semana = $i+1;
                break;
            }
        }
        //echo $semana;
        if(date("w",$fecha)==0 || date("w",$fecha)==1 || date("w",$fecha)==2 || date("w",$fecha)==3) $semana++;
        
        if($semana==0) $semana = $this->GetWeek((date("Y",$fechaBusqueda)-1).'-12-31');
        
        /*if(($fechaBusqueda==strtotime("-3 day",strtotime("1 year",$fecha)) || 
           $fechaBusqueda==strtotime("-2 day",strtotime("1 year",$fecha)) ||
           $fechaBusqueda==strtotime("-1 day",strtotime("1 year",$fecha))) && date("w",$fechaBusqueda)<3)
                $semana = $this->GetWeek(date("Y",$fechaBusqueda).'-01-01');*/
        
        return $semana;
    }
    
    
    function GetWeek2($fecha) { 
        //Get date supplied Timestamp;
        $fecha = strtotime($fecha);
        $year =  date("Y",$fecha);
        $month =  date("m",$fecha);
        $day =  date("d",$fecha);
        
        $thisdate = mktime(0,0,0,$month,$day,$year); 
        //If the 1st day of year is a monday then Day 1 is Jan 1 
        if (date("D", mktime(0,0,0,1,1,$year)) == "Mon"){ 
            $day1=mktime (0,0,0,1,1,$year); 
        } else { 
            //If date supplied is in last 4 days of last year then find the monday before Jan 1 of next year 
            if (date("z", mktime(0,0,0,$month,$day,$year)) >= "361"){ 
                $day1=strtotime("last Monday", mktime(0,0,0,1,1,$year+1)); 
            } else { 
                $day1=strtotime("last Monday", mktime(0,0,0,1,1,$year)); 
            } 
        } 
        // Calcualte how many days have passed since Day 1 
        $dayspassed=(($thisdate - $day1)/60/60/24); 
        //If Day is Sunday then count that day other wise look for the next sunday 
        if (date("D", mktime(0,0,0,$month,$day,$year))=="Sun"){ 
            $sunday = mktime(0,0,0,$month,$day,$year); 
        } else { 
            $sunday = strtotime("next Sunday", mktime(0,0,0,$month,$day,$year));    
        } 
        // Calculate how many more days until Sunday from date supplied 
        $daysleft = (($sunday - $thisdate)/60/60/24); 
        // Add how many days have passed since figured Day 1 
        // plus how many days are left in the week until Sunday 
        // plus 1 for today 
        // and divide by 7 to get what week number it is 
        $thisweek = ($dayspassed + $daysleft+1)/7; 
        return $thisweek; 
    }
    
    function echo_header($num_cols,$n_empresa,$n_reporte)
	{
		echo "<table>
				  <tr>
					  <td align='center' colspan='$num_cols'>$n_empresa</td>
				  </tr>
				  <tr>
					  <td align='center' style='font-weight:bold;background-color:silver;height:30px;font-size:25px; border:1px solid #DDDDDD' colspan='$num_cols'>$n_reporte</td>
				  </tr>
				  <tr>
					  <td align='left' colspan='$num_cols'>GENERADO AL: ".date("Y-m-d H:i:s")."</td>
				  </tr>
				  <tr>
					  <td colspan='$num_cols'>&nbsp;</td>
				  </tr>
                </table>  
			  ";
			  
		/*echo "<table>";
		echo "	<tr>";
		echo "		<td cospan='$num_cols'>HOLA</td>";
		echo "	</tr>";
		echo "</table>";*/
	}
    
    function echo_titulo($num_cols,$n_empresa,$n_reporte)
	{
		echo "<table>
				  <tr>
					  <td align='center' colspan='$num_cols'>$n_empresa</td>
				  </tr>
				  <tr>
					  <td align='left' style='font-weight:bold;height:30px;font-size:20px;' colspan='$num_cols'>$n_reporte</td>
				  </tr>
				  <tr>
					  <td colspan='$num_cols'>&nbsp;</td>
				  </tr>
                </table>  
			  ";
			  
	}
    
    function echo_subtitulo($num_cols,$n_empresa,$n_reporte)
	{
		echo "<table>
				  <tr>
					  <td align='center' colspan='$num_cols'>$n_empresa</td>
				  </tr>
				  <tr>
					  <td align='left' style='font-weight:bold;height:30px;font-size:15px;' colspan='$num_cols'>$n_reporte</td>
				  </tr>
				  <tr>
					  <td colspan='$num_cols'>&nbsp;</td>
				  </tr>
                </table>  
			  ";
			  
	}
    
    function echo_header_costos($num_cols,$n_empresa,$n_reporte)
	{
		echo "<table>
				  <tr>
					  <td align='center' colspan='$num_cols'>$n_empresa</td>
				  </tr>
				  <tr>
					  <td align='center' style='font-weight:bold;background-color:silver;height:30px;font-size:25px; border:1px solid #DDDDDD' colspan='$num_cols'>$n_reporte</td>
				  </tr>
				  <tr>
					  <td align='left' colspan='$num_cols'>GENERADO AL: ".date("Y-m-d H:i:s")."</td>
				  </tr>
				  <tr>
					  <td colspan='$num_cols'>&nbsp;</td>
				  </tr>
			  
			  ";
			  
		/*echo "<table>";
		echo "	<tr>";
		echo "		<td cospan='$num_cols'>HOLA</td>";
		echo "	</tr>";
		echo "</table>";*/
	} 
    
}