<?php
class session_model extends CI_Model
{		
		var $tbl_area= 'sl_m_area';
        function session_model()
		{
			  //$this->load->library('email'); 
		}
        
         
        /**  Controla si hay sesion
         *   Si no muestra view sesion para login.
        */
    	function _controla_sesion()
    	{		
            if ($this->session->userdata('logged_in') != TRUE):
                $this->session->sess_destroy();
                $data['mensaje'] ='Actualmente usted no tiene sesi&oacute;n.<br />Si quiere ver o cambiar datos por favor ingrese con su usuario y contrase&ntilde;a para "Acceder a la p&aacute;gina".';
                
                $this->load->view("no_session",$data);
                return FALSE;
            endif;		  
        	// entonces desde aqui seguramente hay sesion
            return TRUE;
    	} 
        
}

?>