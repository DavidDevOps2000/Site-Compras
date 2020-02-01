<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
    
    public function index(){
        //carregar o cabeçalho
        $this->load->view('includes/header');

        //carregar o menu
        $this->load->view('includes/menu');

        //carrega o corpo da tela
        $this->load->view('v_usuario');

        //carrega rodapé da tela
        $this->load->view('includes/footer');
    }

    public function listar(){
        //Instancio a Model - m_usuario
        $this->load->model('m_usuario');

        //Solicito a execução do método consultar
        $retorno = $this->m_usuario->consultar();

        echo json_encode($retorno->result());
    }

    public function cadastrar(){
        //carregando as variáveis do que foi mandado via post
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $tipo = $this->input->post('cmb-tipo');


        //Instancio a model m_usuario
        $this->load->model('m_usuario');

        //solicito a execução do método validalogin passando os
        //atributos necessários, e atribuindo a $retorno
        
        $retorno = $this->m_usuario->cadastrar($usuario, $senha, $tipo);

        echo $retorno;
    }
    public function consalterar(){
        $usuario = $this->input->post('usuario');

        $this->load->model('m_usuario');

        $retorno = $this->m_usuario->consalterar($usuario);

        echo json_encode($retorno->result());
    }

    public function alterar(){
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $tipo = $this->input->post('tipo');

        $this->load->model('m_usuario');

        $retorno = $this->m_usuario->alterar($usuario, $senha, $tipo);
        echo $retorno;
    }

    public function desativar(){
        $usuario = $this->input->post('usuario');

        $sessao = $this->session->userdata('usuario');

        if($usuario == $sessao){

         echo 2;

        }else{
            $this->load->model('m_usuario');
            $retorno = $this->m_usuario->desativar($usuario,$sessao);

            echo $retorno;
         }

    }

    public function verusu(){
        $usuario = $this->input->post('usuario');

        $this->load->model('m_usuario');

        $retorno = $this->m_usuario->verusu($usuario);
        
        echo $retorno;
    }



    public function reativar(){
        //Carregando a variavél que foi mandada via POST
        $usuario = $this->input->post('usuario');


        //Instancio a Model - m_usuario
        $this->load->model('m_usuario');

        //Solicito a execuçao do método consalterar passando o
        //atributo necessário, e atribuindo a $retorno

        $retorno = $this->m_usuario->reativar($usuario);

        echo $retorno;


    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
}

?>