@extends('layouts.application')

@section('content')
    <fieldset>

        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>

        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>

        <!-- CADASTRO -->

        <h5 class="ls-title-3">Cadastro:</h5>

        <br>

        <style>
            #cadastro {
                color: #000;
                text-decoration: none;
            }

            #cadastro:hover {
                color: #000;
                text-decoration: none;
            }

        </style>

        <p style="font-size: 16px;">
            Caso não tenha acesso ao sistema com login e senha, é requerido
            <b>
                <a id="cadastro" href="{{ route('register') }}">CRIAR UM CADASTRO</a>
            </b>
            pessoal para
            usufruir
            do sistema.
        </p><br>
        <img src="{{ URL::asset('gifs/viewcad.gif') }}" />

        <br><br><br>

        <p style="font-size: 16px;">
            Insira seus dados <b>(NOME, EMAIL, SENHA E SETOR)</b> e finalize seu cadastro.
        </p><br>
        <img src="{{ URL::asset('gifs/cadastro.gif') }}" />

        <!-- /CADASTRO -->

    </fieldset>

@stop
