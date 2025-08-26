@extends('layouts.application')

@section('content')
    <fieldset>

        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>

        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br>
        <style>
            #divAlert {
                width: 35%;
                height: 50px;
                margin-left: 33%;
            }

        </style>

        <div id="divAlert" class="alert alert-primary ls-title-3 text-center" role="alert">
            <h4> Selecione abaixo, qual o tutorial desejado: </h4>
        </div>
        <br><br>

        <div class="row" style="background-color: #faf9f9;">

            <style>
                #thTutorial {
                    text-align: center;
                    border: none;
                    padding: 16px 32px;
                    font-size: 16px;
                    margin: 4px 2px;
                    border-radius: 4px;
                    transition: 0.4s;
                    text-decoration: none;
                }

                #thTutorial:hover {
                    background-color: #1ab551;
                    color: #fff;
                    text-decoration: none;
                }

                a:hover {
                    color: #fff;
                    text-decoration: none;
                }

            </style>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/cad'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Cadastro</h3>
                </button>
            </div>

            <br><br>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/access'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Primeiro Acesso</h3>
                </button>
            </div>

            <br><br>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/vehiclerequest'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Solicitar Viagem</h3>
                </button>
            </div>

            <br><br>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/newsolicity'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Solicitar Várias Viagens</h3>
                </button>
            </div>

            <br><br>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/verifyrequest'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Verificar Solicitação</h3>
                </button>
            </div>

            <br><br>

            <div class="col-md-12">
                <button id="thTutorial" onclick="window.location.href='/informacao/resetpassword'" type="button"
                    class="btn btn-lg btn-block">
                    <h3>Resetar Senha</h3>
                </button>
            </div>
        </div>

    </fieldset>

@stop
