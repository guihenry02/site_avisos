<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setup extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
    }

    public function index(){
        redirect('setup/login', 'refresh');
        
    }

    public function login(){
        
        $dados['value'] = 'Usuário';
        $this->form_validation->set_rules('username', 'USUÁRIO', 'trim|required');

        //verificação da validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                $dados['value'] = 'Parâmetro inválido';
            endif;
        else:
            $dados_form = $this->input->post();
            $this->option->update_option($dados_form['username'], $dados_form['enviar']);
            $this->session->set_userdata('username', $dados_form['username']);
            $this->session->set_userdata('permissao', $dados_form['enviar']);
            redirect('noticia/listar');
        endif;

        //carregar a view
        $this->load->view('login', $dados);
        
    }




}