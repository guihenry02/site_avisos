<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function get_option($option_name){
        $this->db->where("nome", $option_name);
        $query = $this->db->get('user', 1);
        if($query->num_rows() == 1):
            $row = $query->row();
            return $row->option_value;
        else:
            return NULL;
        endif;

    }
    
    public function update_option($option_name, $option_value){
        $this->db->where("nome", $option_name);
        $query = $this->db->get('user', 1);
        if($query->num_rows() == 1):
            //opção ja existe devo alterar ela
            $this->db->set('permissao', $option_value);
            $this->db->where('nome', $option_name);
            $this->db->update('user');
            return $this->db->affected_rows();
        else:
            //a opção não existe devo inserir
            $dados = array(
                'nome' => $option_name,
                'permissao' => $option_value
            );
            $this->db->insert('user', $dados);
            return $this->db->insert_id();
        endif;

    }

    


}
