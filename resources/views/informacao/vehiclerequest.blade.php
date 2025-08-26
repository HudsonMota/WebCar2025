@extends('layouts.application')

@section('content')
    <fieldset>
        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>
        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>
        <!-- SOLICITAÇÃO -->
        <h5 class="ls-title-3">Solicitar Veículo:</h5>

        <br>

        <style>
            #request {
                color: #000;
                text-decoration: none;
            }

            #request:hover {
                color: #000;
                text-decoration: none;
            }

        </style>

        <p style="font-size: 16px;">
            Após o administrador liberar seu acesso, entre na aba <b>SOLICITAÇÕES <i class="ls-ico-shaft-right"> <a
                        id="request" href="/solicitacao-add"></i>Solicitar Veiculo</a></b>.
        </p><br>
        <img src="{{ URL::asset('gifs/solicity1.gif') }}" />

        <br><br><br>

        <h5 class="ls-title-4">Solicitante:</h5>

        <br><br>

        <p style="font-size: 16px;">
            Preencha a solicitação com <b>Nome do Solicitante</b> e <b>Setor Solicitante</b>.
        </p><br>
        <img src="{{ URL::asset('gifs/solicity2.gif') }}" />

        <br><br><br>

        <p style="font-size: 16px;">
            Selecione os endereços de <b>Origem</b> e <b>Destino</b> para traçar a rota solicitada.
        </p><br>
        <img src="{{ URL::asset('gifs/solicity3.gif') }}" />

        <br><br><br>

        <h5 class="ls-title-4">Finalidade:</h5>

        <br><br>

        <h5>Existem <b>3</b> opções para finalidade, verifique sua solicitação e selecione a correta</h5>

        <br><br>

        <h3><b>1</b></h3>
        <p style="font-size: 16px;">
            Informe a <b>Unidade</b>, o <b>número do Leito</b>, o <b>Motivo da Solicitação</b> e as <b>Condições /
                Outros</b>.
        </p><br>
        <img src="{{ URL::asset('gifs/solicity4.gif') }}" />

        <br><br><br>

        <h3><b>2</b></h3>
        <p style="font-size: 16px;">
            Digite quais materiais serão transportados e se existe alguma documentação assinada
        </p><br>
        <img src="{{ URL::asset('gifs/solicity5.gif') }}" />

        <br><br><br>

        <h3><b>3</b></h3>
        <p style="font-size: 16px;">
            Caso nenhuma das 3 opções atendam a solicitação, informe quais serão os critérios da solicitação.
        </p><br>
        <img src="{{ URL::asset('gifs/solicity6.gif') }}" />

        <br><br><br>

        <h5 class="ls-title-4">Agendamento:</h5>

        <br><br>

        <p style="font-size: 16px;">
            Informe a <b>Data</b> e <b>Hora</b> desejado para solicitação.<br>
        </p><br>
        <img src="{{ URL::asset('gifs/solicity7.gif') }}" />

        <br><br><br>

        <h5 class="ls-title-4">Nova Solicitação:</h5>

        <br><br>

        <p style="font-size: 16px;">
            Caso haja mais de um local informado na solicitação.<br><br>
            Ex.: <br>
            <b>Origem:</b> HSJ, &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino 1:</b> SESA, &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp;
            <b>Destino 2:</b> LACEN<br><br>
            é necessário criar uma nova solicitação
        </p><br>
        <img src="{{ URL::asset('gifs/newsolicity.gif') }}" />

        <br><br>

        <p style="font-size: 16px;">
            A nova solicitação deve informar o local de Destino da solicitação anterior como <b>Origem</b> e informar a
            segunda
            localização como <b>Destino</b> final.<br><br>
            Ex.: <br>
            <b>Origem:</b> HSJ &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino:</b> SESA<br><br>
            <b>Origem:</b> SESA &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino:</b> LACEN<br><br><br>
            Após informar os endereços, seguir o mesmo passo da solicitação anterior, passando as informações que serão
            utilizadas no segundo local, e finalizar.

        </p><br>
        <img src="{{ URL::asset('gifs/newsolicity2.gif') }}" />

        <!-- /SOLICITAÇÃO -->

    </fieldset>
@stop
