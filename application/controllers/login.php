<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

    
	public function index()
	{
        $this->load->view('includes/header');
        $this->load->view('v_login');
        $this->load->view('includes/footer');

	}   
	public function logar_ajax()
	{
		//armazendo os dados via post nos dois atributos
		$usuario = $this->input->post('txtUsuario');
		$senha = $this->input->post('txtSenha');

		
		//instancio a model
		$this->load->model('m_acesso');
		
		$retorno = $this->m_acesso->validalogin($usuario, $senha);
		// $retorno2 = $this->m_acesso->pegarTipo($usuario);
		//Verifico se a autentificação foi validada
		if($retorno == 1){
			//Atribuo a variavel de sessão, usuario
			$_SESSION['usuario'] = $usuario;
			// $_SESSION['tipo'] = $retorno2;
		}else{
			//caso conrario, destruo a sessão
			unset($_SESSION['usuario']);
		}
		//retorno pra view a respota	

		echo $retorno;
	}

	
}
