<?php

class Ventas__model extends CI_Model {
    
    public function __construct(){
        Parent::__construct();
    }
    
    public function get($id = null) {
        
        if(!is_null($id)){
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
      
            $this->db->select('id, date');
            $this->db->from('account_invoicing');
            $query = $this->db->get();
      
      if($query->num_rows() > 0){
          return $query->result_array();
      }
      
      return false;
      
    }
}
