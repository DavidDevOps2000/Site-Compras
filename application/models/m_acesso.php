<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_acesso extends CI_Model{

        public function validalogin($usuario, $senha){
            $retorno = $this->db->query("select * from usuarios where usuario = '$usuario' and senha = '$senha' and estatus = ''");
            $tipo = $retorno->row()->tipo;
            $_SESSION['tipo'] = $tipo;

            if($retorno->num_rows() > 0){//Se a Variavel retorno tiver um (1) retornando por ser True
                return 1;				//Então será retornado 1 ao executar esse metodo
            }else{
                return 0;//Caso não ache o dado inserido pelo Usuario, retornará 0 ou nesse caso False
            }
        }

        // public function pegarTipo($usuario){
        //     $retorno = $this->db->query("select * from usuarios where usuario = '$usuario' and estatus = ''");

        //     if ($retorno->num_rows() > 0){
        //         $retorno = $retorno->row();
        //         $retorno = $retorno->tipo;
        //         return $retorno;
        //     }else{
        //         return 0;
        //     }
        // }

        // public function validaTipo($usuario){
        //     $resultado = $this->db->query("select tipo from usuarios where = '$usuario'");                    
            
        
        // }

        public function validacadastro($usuario, $senha){
            $retorno = $this->db->query("select * from usuarios where usuario = '$usuario' and senha = '$senha' and estatus = ''");
            
            if($retorno->num_rows() > 0){       
                
                return 0;

            }else if($retorno->num_rows() == 0){
                $retorno = $this->db->query("Insert into usuarios(usuario, senha) values ('$usuario','$senha')");
                 
                return 1;
            }else{
                return 2;
            }
        }
    }

?>