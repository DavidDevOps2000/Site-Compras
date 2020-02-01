<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <form id="formCadastro">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4>Cadastro de usuários</h4>
                    </div>

                    <div class="panel-body">
                        <div class="form-group col-lg-6">
                            <label for="textNome" class="control-label">Usuário:</label>
                            <input name="usuario" id="usuario" class="form-control" placeholder="Digite seu Nome" onblur="Verifica();" type="text" required>
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label for="textUsuario" class="control-label">Tipo</label>
                            <select name="cmb-tipo" id="cmb-tipo" class="form-control selectpicker" data-container="body" data-width="100%" required>
                                <option></option>
                                <option>ADMINISTRADOR</option> 
                                <option>COMUM</option>
                            </select>     
                        </div>  

                        <div class="form-group col-lg-6">      
                            <label for="inputPassword" class="control-label">Senha</label>      
                            <input type="password" class="form-control" placeholder="Informe sua senha" 
                                  name="senha" id="senha" data-minlength="6" required>      
                        </div>
                        <div class="form-group col-lg-6">      
                            <label for="inputPassword" class="control-label">Confirmação</label>      
                            <input type="password" class="form-control" placeholder="Confirme sua senha" 
                                  name="csenha" id="csenha" data-minlength="6" required>      
                        </div>      
                    </div>
                    <div class="panel-footer clearfix">
                        <div class="btn-group pull-left">      
                            <button type="reset" class="btn btn-lg btn-danger" id = "btnlimpar">Limpar</button>
                        </div> 
                        <div class="btn-group pull-right">      
                            <button type="submit" class="btn btn-lg btn-primary">Salvar</button>
                        </div> 
                    </div>
                </div>
            </form>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h1 class="panel-title">Usuários cadastrados</h1>
                </div>
                <div class="panel-body margem">
                    <table id ="tableusu"
                        data-toggle ="table"
                        data-height ="205"
                        data-search ="true"
                        accesskey=""
                        data-side-pagination ="client"
                        data-pagination ="true"
                        data-page-list="[5,10,15]"
                        data-pagination-first-text="First"
                        data-pagination-pre-text="Previous"   
                        data-pagination-next-text="Next"
                        data-pagination-last-text="Last"
                        data-url= 'usuario/listar'>  
                        <!--Endereço do Controller responsável em buscar os dados da lista -->
                        <thead>
                            <tr>
                                <th data-field = 'usuario' class = "col-md-3 text-left">Usuario</th> 
                                <!--campo que retornará do Contoller deverá ser incluídio no data-field -->
                                <th data-field = 'senha' class = "col-md-3">Senha</th>
                                <!--campo que retornará do Contoller deverá ser incluídio no data-field -->
                                <th data-field = 'tipo' id="tipoCampo" class = "col-md-2 text-left">Tipo</th> 
                                <!--campo que retornará do Contoller deverá ser incluídio no data-field -->
                                <th data-field = 'estatus' class = "col-md-2 text-left">Status</th> 
                                <!--campo que retornará do Contoller deverá ser incluídio no data-field -->
                                <th  class = "col-md-2" data-formatter="opcoes" data-field ="usuario">Ação</th>
                                <!--colocaremos a função data-formatter que chamará a função JavaScript
                                 opcoes e não podemos esquecer de amarrar no data-field o campo que será o parâmetro de busca 
                                -->
                            </tr>
                        </thead>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal de atualização do usuario -->
<div class="modal fade" id="alteracao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel">Alterar dados do usuario</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-xs-6 col-md-6">
                        <label class="control-label">Usuário:</label>
                        <input name="musuario" id="musuario" class="form-control" placeholder="usuário" type="text" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="textUsuario" class="control-label">Tipo</label>
                        <select name="mcmb-tipo" id="mcmb-tipo" class="form-control selectpicker" data-container="body" data-width="100%" required>
                            <option></option>
                            <option>ADMINISTRADOR</option> 
                            <option>COMUM</option>
                        </select>     
                    </div>  

                    <div class="form-group col-xs-6 col-md-6">
                        <label class="control-label">Senha:</label>
                        <input type="password" class="form-control" placeholder="Senha" name="msenha" id="msenha" required>
                    </div>
                    <div class="form-group col-lg-6">      
                        <label for="inputPassword" class="control-label">Confirmação</label>      
                        <input type="password" class="form-control" placeholder="Confirme sua senha" 
                              name="mcsenha" id="mcsenha" data-minlength="6" required>      
                    </div>                   
                </div>
            </div>
            <div class="modal-footer" style="background-color: #A9A9A9;">
                <button type="submit" class="btn btn-lg btn-primary" onClick="alterar();">Alterar</button>
                <button type="button" class="btn btn-lg btn-primary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        //Salva o cadastro do usuário
        $("#formCadastro").submit(function(event){
            if($("#senha").val() != $("#csenha").val()){
                swal({
                    title: "Atenção!",
                    text: "Senhas incompatíveis, verifique!",
                    type:"error",
                });
                return false;
            }else{
                $.ajax({
                    type: "POST",
                    url: "usuario/cadastrar",
                    data: $("#formCadastro").serialize(),
                    success: function(data){
                        if($.trim(data) == 1){

                            $("#formCadastro").trigger("reset");
                            swal({title: "OK!", text: "Dados salvos com sucesso.", type: "success"});
                        }else{
                            swal({title: "ATENÇÃO!", text: "Erro ao inserir, verifique!", type: "error",});
                        }

                    },
                    beforeSend: function(){
                        swal({title: "AGUARDE!", text: "Carregando...", imageUrl: "assets/img/gifs/preloader.gif",});
                    },
                    error: function(){
                        alert:("Unexpected error.");
                
                    }
                });
                return false;
            }
        });
        setInterval(function(){
            var $table = $('#tableusu');
            $table.bootstrapTable('refresh');
        }, 5000)
    });
        //função que faz aparereces 2 botoes o de busca e o de desativar
    function opcoes(value, row, index){
        if(row.estatus =='DESATIVADO'){
        var opcoes = '<button class="btn btn-xs btn-warning text-center" type="button"  onClick="reativa_usuario('+"'"+ value +"'"+');"><span class="glyphicon glyphicon-open"></span></button>';

        }else{

        var opcoes = '<button class = "btn btn-xs btn-primary text-center" type="button" onclick="busca_usuario('+ "'" + value + "'" +');"><span class = "glyphicon glyphicon-pencil"></span></button>\n\
        <button class = "btn btn-xs btn-danger text-center" type="button" onclick="desativa_usuario('+ "'" + value + "'" +');"><span class = "glyphicon glyphicon-trash"></span></button>';
        }
        return opcoes;
    }

    //função de busca de usuario que aparece um modal.
    function busca_usuario(usuario){
        $('#alteracao').modal('show');
        $.ajax({
            type: "POST",
            url: 'usuario/consalterar',
            dataType: 'json',
            data: {'usuario': usuario},
            success: function (data){
                $('#musuario').val(data[0].usuario);
                $('#msenha').val(data[0].senha);
                swal.close();
            },
            beforeSend: function(){
                swal({
                    title: "Aguarde!",
                    text: "Carregando...",
                    imageUrl: "assets/img/gifs/preloader.gif",
                    showConfirmButton: false
                });
            },
            error: function(){
                alert('Unexpected error.');
                swal.close();
            }
        });
    }

    //Botão alterar dentro do modal recebe essa função
    function alterar(){
        if($("#msenha").val() != $("#mcsenha").val()){
            swal({
                title: "Atenção!",
                text: "senhas incompatíveis, verifique!",
                type: "error"
            });
            return false;
        }else{     
            $.ajax({
                type: "POST",
                url: 'usuario/alterar',
                data: {'senha':$('#msenha').val(),
                        'usuario':$('#musuario').val(),
                        'tipo':$('#mcmb-tipo').val()},
                success: function(data){
                    if(data == 1){
                        swal({
                            title: "OK",
                            text: "Senha ALTERADA!",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#54DD74",
                            confirmButtonText: "OK!",
                            closeOnConfirm: true,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if(isConfirm){
                                $('#tableusu').bootstrapTable('refresh');
                                
                            }
                        });
                        $('#alteracao').modal('hide');
                        
                        
                    }else{
                        swal({
                            title: "OK",
                            text: "Erro na ALTERAÇÃO, verifique!",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#54DD74",
                            confirmButtonText: "OK!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        });
                    }
                },
                beforeSend: function(){
                    swal({
                        title: "Aguarde!",
                        text: "Carregando...",
                        imageUrl: "assets/img/gifs/preloader.gif",
                        showConfirmButton: false
                    });
                },
                error: function(){
                    alert('Unexpected error.')
                }
            });
        }
    }


    // tipo = document.getElementById('tipoCampo').text;
    // alert(tipo);

    //Desativar o usuario!
function desativa_usuario(usuario){

            swal({
                  title:"Atenção",
                  type: "Gostaria de DESATIVAR esse Usuário?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "DD6B55",
                  confirmButtonText: "Sim",
                  cancelButtonText: "Não",
                  closeOnConfirm: false,
                  closeOnCancel: true
                  },
                  function(isConfirm){
                  if(isConfirm){
                     $.ajax({
                        url: base_url + "usuario/desativar",
                        type: "POST",
                        data: {'usuario':usuario},
                        success: function(data){
                            // nome = data[0].usuario;
                            // alert(nome);
                            
                            if(data == 2){
                                swal({
                                    title: "Atenção",
                                    text: "Vc não pode desativar a si mesmo",
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "54DD74",
                                    confirmButtonText: "OK!",
                                    cacelButtonText: "",
                                    closeOnConfirm:true,
                                    closeOnCancel: false
                                });
                            }else if(data == 1){
                                swal({
                                    title: "OK",
                                    text: "Usuário DESATIVADO!",
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "54DD74",
                                    confirmButtonText: "OK!",
                                    cacelButtonText: "",
                                    closeOnConfirm:true,
                                    closeOnCancel: false
                                },
                            function(isConfirm){
                                if(isConfirm){
                                    $('#tableusu').bootstrapTable('refresh');
                                }
                            });
                            }else{
                                swal({
                                    title: "OK!",
                                    text: "Erro na DESATIVAÇÃO, verifique!",
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "54DD74",
                                    confirmButtonText: "OK!",
                                    cacelButtonText: "",
                                    closeOnConfirm:false,
                                    closeOnCancel: false
                                });
                            }
                        },
                        beforeSend: function(){
                            swal({
                                title: "Aguarde!",
                                text: "Gravando dados...",
                                imageUrl: "assets/img/alertas/loading.gif",
                                showConfirmButton: false
                            });
                        },
                        error: function(data_error){
                            sweetAlert("Atenção", "Erro ao gravar os dados!", "error");
                        }
                    });
                }
            });
        }
    

        function Verifica(){
            $.ajax({
                type: "POST",
                url: 'usuario/verusu',
                data: {'usuario':$('#usuario').val()},
                success: function(data){
                    if (data == 1){
                        swal({
                            title: "OK",
                            text: "Usuário ja cadastrado na base de dados, verifique!",
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#54DD74",
                            confirmButtonText: "OK!",
                            closeOnConfirm: true,
                            closeOnCancel: false
                        });
                        $('#btnlimpar').click();
                        $('#usuario'.focus());
                    }else{
                        swal.close();
                    }
                },
                beforeSend: function(){
                    swal({
                        title: "Aguarde!",
                        text: "Carregando...",
                        imageUrl: "assets/img/gifs/preloader.gif",
                        showConfirmButton: false
                    });
                },
                error: function() {
                    alert('Error');
                }
            });
        }
//Função para REATIVAR o usuario
function reativa_usuario(usuario){
    swal({
        title:"Atenção",
        type:"Gostaria de REATIVAR esse Usuário?",
        type:"warning",
        showCancelButton:true,
        confirmButtonColor:"#DD6B55",
        confirmButtonText:"Sim",
        cancelButtonText:"Não",
        closeOnConfirm:false,
        closeOnCancel:true},

        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url:base_url + "usuario/reativar",
                    type:"POST",
                    data:{'usuario':usuario},

                    success:function(data){
                        if(data == 1){
                            swal({
                                title:"OK",
                                text:"Usuário REATIVADO",
                                type:"success",
                                showCancelButton:false,
                                confirmButtonColor:"#54DD74",
                                confirmButtonText:"OK!",
                                cancelButtonText:"",
                                closeOnConfirm:true,
                                closeOnCancel:false
                            },
                            function(isConfirm){
                                if(isConfirm){
                                    $('#tableusu').bootstrapTable('refresh');
                                }
                            });
                        }else{
                            swal({
                                title:"OK",
                                text:"Erro na REATIVAÇÃO, Verifique!",
                                type:"error",
                                showCancelButton:false,
                                confirmButtonColor:"#54DD74",
                                confirmButtonText:"OK!",
                                cancelButtonText:"",
                                closeOnCancel:false,
                                closeOnCancel:false
                            });
                        }
                    },
                    beforeSend: function(){
                        swal({
                            title:"Aguarde!",
                            text:"Gravando dados...",
                            imageUrl:"assets/img/alertas/loading.gif",
                            showConfirmButton:false
                        });
                    },
                    error:function(data_error){
                        sweetAlert("Atenção", "Erro ao gravar os dados!","error");
                    }
                });
            
        }
    });
}
</script>
