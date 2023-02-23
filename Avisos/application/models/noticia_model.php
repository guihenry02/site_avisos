<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function salvar($dados){
        if(isset($dados['id']) and $dados['id'] > 0):
            //noticia ja existe, devo editar
            $this->db->where('id', $dados['id']);
            unset($dados['id']);
            $this->db->update('boletins', $dados);
            return $this->db->affected_rows();
        else:
            //noticia não existe, devo inserir
            $this->db->insert('boletins', $dados);
            return $this->db->insert_id();
        endif;
    }

    public function search_value($title, $type = null, $permission = null){
        $this->db->like('titulo', $title);
      //$this->db->like('tipo_aviso', $type);
      //$this->db->like('nivel_permissao', $permission);

        $query = $this->db->get('boletins');
        if($query->num_rows() > 0):
            return $query->result();
        else:
            return NULL;
        endif;
    }

    public function get($limit = 0, $offset=0){
        if($limit == 0):
            $this->db->order_by('id','desc');
            $query = $this->db->get('boletins');
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        else:
            $this->db->order_by('id','desc');
            $query = $this->db->get('boletins', $limit);
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL; 
            endif;
        endif; 
    }

    public function get_single($id = 0){
        $this->db->where('id', $id);
        $query = $this->db->get('boletins',1);
        if($query -> num_rows() == 1):
            $row = $query->row();
            return $row;
        else:
            return NULL;
        endif;

    }

    public function excluir($id = 0){
        $this->db->where('id', $id);
        $this->db->delete('boletins');
        return $this->db->affected_rows();
    }
}

