<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noticia extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper("form");
        $this->load->library('form_validation');
        $this->load->model('option_model', 'option');
        $this->load->model('noticia_model','noticia');
        
    }

    public function index(){
        redirect('noticia/listar');
    }

    public function listar(){
        $dados['noticias'] = $this->noticia->get();

        $dados['tela1'] = 'geral';
        $this->load->view('noticias', $dados);
    }

    public function filtrar(){
        //regras de validação
        $dados['check_filtro'] = TRUE;
        $dados['value'] = 'Escreva um título para filtrar';
        $this->form_validation->set_rules('filtro_titulo', 'FILTRO', 'trim|required');
        //confirmação da validação
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
               $dados['value'] = 'Parâmetros inválidos';
            endif;
        else:
            $dados['check_filtro'] = FALSE;
            $dados_form = $this->input->post();
            $dados_filtro['filtro_titulo'] = $dados_form['filtro_titulo'];
            $dados['noticias'] = $this->noticia->search_value($dados_filtro['filtro_titulo']);
            
        endif;

        //carregar view e passar dados para a view

        $dados['tela1'] = 'filtrar';
        $this->load->view('noticias', $dados);
        
        
    }

    public function post(){
        $id = $this->uri->segment(3);
        if($id>0):
            if($noticia = $this->noticia->get_single($id));
            $dados['noticias'] = $noticia;
            if($noticia->nivel_permissao == 0):
                    $noticia->nivel_permissao = 'Geral';
                else:
                    if($noticia->nivel_permissao == 1):
                        $noticia->nivel_permissao = 'Funcionário';
                    else:
                        $noticia->nivel_permissao = 'Diretoria';
                    endif;
                endif;
        else:
            redirect('noticia', 'refresh');
        endif;
        $dados['tela1'] = 'ler';
        $this->load->view('noticias', $dados);
    }



    public function cadastrar(){
        //regras de validação
        $dados['value'] = NULL;
        $dados['value'] = NULL;
        $this->form_validation->set_rules('titulo','TÍTULO','trim|required');
        $this->form_validation->set_rules('conteudo','CONTEÚDO','trim|required');
        $this->form_validation->set_rules('options[]','CAIXAS','required');
        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                $dados['value'] = 'Preencha todos os campos corretamente';
                $dados['value1'] = 'Título e conteudo devem conter mais de 10 caracteres';
            endif;

        else:
            $dados_form = $this->input->post();
            $dados_insert['titulo'] = $dados_form['titulo'];
            $dados_insert['conteudo'] = $dados_form['conteudo'];
            $dados_insert['nivel_permissao'] = $dados_form['permissao'];
            $dados_insert['tipo_aviso'] = implode(', ',$dados_form['options']);
            $dados_insert['data'] = date('Ymd');
            $dados_insert['remetente'] = $_SESSION['username'];
            if($id = $this->noticia->salvar($dados_insert)):
                echo '<h2>Notícia cadastrada com sucesso</h2>';
                redirect('noticia/listar');
            else:
                echo '<h2>Erro no cadastro da notícia</h2>';


            endif;
        endif;

        //carregar views com dados
        $dados['tela'] = 'cadastrar';
        $this->load->view('forms', $dados);
        
    }

    public function excluir(){
        
        $id = $this->uri->segment(3);
        if($id>0):
            //id informado continuar com a exclusão
            if($noticia = $this->noticia->get_single($id)):
                $dados['noticias'] = $noticia;
                if($noticia->nivel_permissao == 0):
                    $noticia->nivel_permissao = 'Geral';
                else:
                    if($noticia->nivel_permissao == 1):
                        $noticia->nivel_permissao = 'Funcionário';
                    else:
                        $noticia->nivel_permissao = 'Diretoria';
                    endif;
                endif;

            else:
                redirect('noticia/listar', 'refresh');
                set_msg("<p>Noticia inexistente!</p>");
            endif;
        else:
            set_msg('<Você deve escolher uma notícia para excluir></p>');
            redirect('noticia/listar','refresh');
        endif;
        if (($_SESSION['permissao'] == $noticia->nivel_permissao) or ($noticia->nivel_permissao == 'Geral')):
            if($this->noticia->excluir($id)):
                redirect('noticia/listar', 'refresh');
            endif;
        else:
            $dados['tela1'] = 'ler';
            $this->load->view('noticias', $dados);
        endif;
        

    }

    public function editar(){

        $id = $this->uri->segment(3);
        if($id>0):
            //id informado continuar com a edição
            if($noticia = $this->noticia->get_single($id)):
                $dados['noticias'] = $noticia;
                $dados_update['id'] = $noticia->id;
                if($noticia->nivel_permissao == 0):
                    $noticia->nivel_permissao = 'Geral';
                else:
                    if($noticia->nivel_permissao == 1):
                        $noticia->nivel_permissao = 'Funcionário';
                    else:
                        $noticia->nivel_permissao = 'Diretoria';
                    endif;
                endif;
            else:
                redirect('noticia/listar', 'refresh');
                set_msg("<p>Noticia inexistente!</p>");
            endif;
        else:
            set_msg('<Você deve escolher uma notícia para editar></p>');
            redirect('noticia/listar','refresh');
        endif;

        //regras de validação
        if (($_SESSION['permissao'] == $noticia->nivel_permissao) or ($noticia->nivel_permissao == 'Geral')):
            $dados['value'] = NULL;
            $this->form_validation->set_rules('titulo','TÍTULO','trim|required');
            $this->form_validation->set_rules('conteudo','CONTEÚDO','trim|required');
            $this->form_validation->set_rules('options[]','CAIXAS','required');
            //verifica a validação
            if($this->form_validation->run() == FALSE):
                if(validation_errors()):
                    $dados['value'] = "<H3>Passe os parâmetros corretamente</H3>";
                endif;
            else:
                $dados_form = $this->input->post();
                $dados_update['titulo'] = $dados_form['titulo'];
                $dados_update['conteudo'] = $dados_form['conteudo'];
                $dados_update['nivel_permissao'] = $dados_form['permissao'];
                $dados_update['tipo_aviso'] = implode(', ',$dados_form['options']);
                $dados_update['data'] = date('Ymd');
                if($this->noticia->salvar($dados_update)):
                    set_msg('<p>Notícia alterada com sucesso</p>');
                    redirect('noticia');
                else:
                    set_msg('<p>nenhuma alteração foi feita</p>');
                endif;
            endif;
            $dados['tela'] = 'editar';
            $this->load->view('forms', $dados);
        else:
            $dados['tela1'] = 'ler';
            $this->load->view('noticias', $dados);
        endif;


    }


}
