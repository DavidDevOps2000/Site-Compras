<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class M_usuario extends CI_Model{
        
        public function cadastrar($usuario, $senha, $tipo){
            $retorno = $this->db->query("select * from usuarios where usuario = '$usuario' and estatus = 'D'");
            if ($retorno->num_rows() == 0){
                $this->db->query("insert into usuarios (usuario, senha, tipo) values ('$usuario','$senha', '$tipo')");
                //verifica a inserção
                if($this->db->affected_rows() > 0){
                    //Inserção com sucesso
                    return 1;
                }else{
                    //problema ao inserir
                    return 0;
                }
            }else{
                return 2;
            }

        }
    

        public function consultar(){
            //instrução que executa a query no banco de dados
            $retorno = $this->db->query("SELECT usuario, senha, tipo, case estatus 
                                                when 'D' then 
                                                'DESATIVADO' 
                                                else
                                                    'ATIVO'
                                                    end estatus
                                                    from usuarios");
            
            //Retorno o resultado do select
            if($retorno->num_rows() > 0){
                return $retorno;
            }
        }

        // public function verifTipoConta(){//Verificando se vc é COMUM

        //     $retorno = $this->db->query("SELECT tipo FROM usuarios WHERE tipo = 'COMUM'");
        //     if($retorno->num_row() >0){

        //     }
        // }
        
        

        public function consalterar($usuario){
            $retorno = $this->db->query("SELECT usuario, senha FROM usuarios WHERE usuario = '$usuario'");
    
            if($retorno->num_rows() > 0){
                return $retorno;
            }
        }

        public function alterar($usuario, $senha, $tipo){
            $retorno = $this->db->query("update usuarios set senha = '$senha', tipo = '$tipo' where usuario = '$usuario'");

            if($this->db->affected_rows() > 0){
                return 1;

            }
            else{
                return 0;
            }
        }
        public function desativar($usuario){            
                        
        $retorno = $this->db->query("update usuarios set estatus = 'D' where usuario = '$usuario'");

        if($this->db->affected_rows()>0){
            return 1;//Alterado com sucesso
        }else{
            return 0;//Problema ao alterar
        
        }
        }

        public function verusu($usuario){
            $retorno = $this->db->query("select * from usuarios where usuario = '$usuario'");

            if($this->db->affected_rows() > 0){
                //Atualizado com sucesso
                return 1;
            }
            else{
                return 0;
            }
        }

        public function reativar($usuario){
            //Instrução que a Query no banco
            $retorno = $this->db->query("UPDATE usuarios set estatus='' WHERE usuario = '$usuario'");

            if($this->db->affected_rows() > 0){
                //Atualizando com sucesso
                return 1;
            }else{
                //Problema ao alterar
                return 0;
            }
        }

        


    }
?>