@extends('layouts.application')

@section('content')
    <fieldset>
        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>
        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>

        <!-- PRIMEIRO ACESSO -->

        <h5 class="ls-title-3">Primeiro Acesso:</h5>

        <br>

        <style>
            #sobre {
                color: #000;
                text-decoration: none;
            }

            #sobre:hover {
                color: #000;
                text-decoration: none;
            }

        </style>

        <p style="font-size: 16px;">
            Ao criar o cadastro, <b>SOLICITE O ADMINISTRADOR</b> para que ele libero o acesso ao seu usuário.
        </p><br>
        <img src="{{ URL::asset('gifs/accessdenied.gif') }}" />

        <br><br><br>

        <p style="font-size: 16px;">
            Algumas informações sobre o WebCar encontram-se na aba
            <b><a id="sobre" href="/informacao/add">SOBRE</a></b> , visite-a.
        </p><br>
        <img src="{{ URL::asset('gifs/inform.gif') }}" />

        <!-- /PRIMEIRO ACESSO -->

    </fieldset>

    <br><br><br>

    <br>
@stop
