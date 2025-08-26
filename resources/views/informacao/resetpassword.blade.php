@extends('layouts.application')

@section('content')
    <fieldset>
        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>
        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>
        <!-- RESETAR SENHA -->
        <h5 class="ls-title-3">Resetar Senha:</h5>

        <br>

        <style>
            #reset {
                color: #000;
                text-decoration: none;
            }

            #reset:hover {
                color: #000;
                text-decoration: none;
            }

        </style>

        <p style="font-size: 16px;">

            Em caso de perda de senha, é possivel alterar em &nbsp;
            @if (Route::has('password.request'))
                <b><a id="reset" href="{{ route('password.request') }}" style="color: black;">
                        {{ __('Esqueceu sua senha?') }}
                    </a></b>
            @endif
            &nbsp; digitar o endereço de email, e enviar a solicitação. <br> Após o processo, verificar a caixa de email e
            redefinir a senha.
        </p><br>
        <img src="{{ URL::asset('gifs/resetpass.gif') }}" />
        <!-- /RESETAR SENHA -->

    </fieldset>
@stop
