<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {
    
    public function cadastrar_ajax()
        {
            
            $usuario = $this->input->post('txtUsuario');
            $senha = $this->input->post('txtSenha');

            $this->load->model('m_acesso');

            $retorno = $this->m_acesso->validacadastro($usuario, $senha);

            if($retorno == 1){
                $_SESSION['usuario'] = $usuario;
            }else{
                unset($_SESSION['usuario']);
            }

            echo $retorno;
        }
}