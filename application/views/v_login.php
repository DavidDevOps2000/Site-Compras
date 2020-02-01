<html>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="login-panel panel panel-info" style="margin-top: 150px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-sign-in"></i> Login</h3>
                    </div>
                    <div class="panel-body">
                        <form autocomplete="off" id="loginComAjax">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="txtUsuario" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="txtSenha" type="password" required>
                                </div>
                                <button type="submit" id="btnEntrar" class="btn btn-block btn-primary"> Entrar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</html>

 <script type="text/javascript" src=<?php echo strtoupper($this->session->userdata('usuario'))?>>
 </script> <!--//Aqui Será lhe dará a resposta se seu acesso foi liberado ou não-->
    <script type="text/javascript">
        $(document).ready(function(){

            $("#loginComAjax").submit(function(event){
                $.ajax({
                    type:"POST",// Os dados serão enviado via Post e não Get
                    url: 'Login/Logar_ajax',//Controller login no metodo logar_ajax
                    data: $("#loginComAjax").serialize(),//Todos os id pertecentes Form poderão
                                                        //ser instanciados na controller
                    success:function(data){//Caso toda a controller funcione corretamente
                      if ($.trim(data) == '1') { //Valido o retorno da controller

                        //swal({//Caso retorne algo exibe uma mensagem ao usuario
                           // title: "Atenção!",
                           // text: "Acesso liberado!",
                            //type:"success",

                        //});
                       // $("#loginComAjax").trigger('reset'); //Limpa os objetos de tela
                        //Login correto, aponto para a controller home, que carregará o menu
                        window.location.href = "home"; 
                        
                        }else{
                            swal({ //Caso retorne algo exibe uma mensagem ao usuario
                                title: "Atenção!",
                                text:"Acesso negado, Usuário ou senha inválido!",
                                type:"error", 
                            });
                            $("#loginComAjax").trigger('reset'); //Limpa os objetos de tela
                        }  

                    },
                    beforeSend: function(){ //Função serve para enquanto o processamento
                                            //estiver ocorrendo exibe uma msg na tela para o usuario
                        swal({
                            title:"Aguarde!",
                            text:"Carregando...",
                            imageUrl: "assets/img/gifs/preloader.gif",
                            showConfirmButton: false

                        });
                    },
                        error:function(){ //Caso aconteça algum erro inesperado no Ajax
                        alert('Deu Erro.');

                        }

                });
                return false;
              });

        });
    
</script>