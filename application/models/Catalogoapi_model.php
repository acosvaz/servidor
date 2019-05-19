<?php

class Catalogoapi_model extends CI_Model {
    
    public function __construct(){
        Parent::__construct();
    }
			//$id=null    
    public function get() {
        
        /*if(!is_null($id)){
            $this->db->select('c.id, c.nombre, c.descripcion, co.nombre_consola, c.sub_imagen1, c.sub_imagen2, c.sub_imagen3, c.sub_imagen4');
            $this->db->from('eg_catalago as c');
            $this->db->join('eg_consolas as co' , 'c.nu_consola=co.id','left');
            $this->db->where('c.id', $id);
            $query = $this->db->get();
            
            if ($query->num_rows() === 1){
            return $query->result_array();
            
            }
            
            return false;
            
        }
      
            $this->db->select('date, amount_total');
            $this->db->from('account_invoice');
            $query = $this->db->get();
      
      if($query->num_rows() > 0){
          return $query->result_array();
      }
      
      return false;
      
    }*/
	$query = $this->db->get('account_invoice');
        foreach ($query->result() as $row)
        {
            $user_data[] = [
                'date' => $row->date,
                'amount_total' => $row->amount_total,
            ];
        }
        return $user_data;
    }
}
