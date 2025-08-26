@extends('layouts.application')

@section('content')
    <fieldset>
        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>
        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>
        <!-- VERIFICAR SOLICITAÇÃO -->
        <h5 class="ls-title-3">Verificar Solicitação:</h5>

        <br>

        <style>
            #verify {
                color: #000;
                text-decoration: none;
            }

            #verify:hover {
                color: #000;
                text-decoration: none;
            }

        </style>

        <p style="font-size: 16px;">

            Ao acessar a <b><a id="verify" href="/" style="color: black;">Pagina Inicial</a></b> é possivel ver as
            solicitações pendentes.<br>
            Mas, ao acessar <b>Solicitações <i class="ls-ico-shaft-right"><a id="verify" href="{{ route('solicitacoes') }}" style="color: black;"></i>
                    Verificar Solicitações</a></b>, é possivel listar todas,
            tanto pendentes, quanto realizadas.
        </p><br>
        <img src="{{ URL::asset('gifs/verify.gif') }}" />

        <!-- /VERIFICAR SOLICITAÇÃO -->

    </fieldset>

@stop
