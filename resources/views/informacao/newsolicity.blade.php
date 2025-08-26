@extends('layouts.application')

@section('content')
    <fieldset>
        <link rel="stylesheet" href="{{ asset('css/tutoriais.css') }}">
        <h1 class="ls-title-intro ls-ico-question">Tutorial do Sistema</h1>

        <br>
        <h3 class="ls-title-3">WEBCAR 2ª VERSÃO</h3>

        <br><br>
        <!-- SOLICITAÇÃO -->

        <h5 class="ls-title-3">Solicitar Veiculo Para Várias Viagens:</h5>

        <br><br>

        <p style="font-size: 16px;">
            Caso haja mais de um local informado na solicitação,<br><br>
            Ex.: <br>
            <b>Origem:</b> HSJ, &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino 1:</b> SESA, &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp;
            <b>Destino 2:</b> LACEN<br><br>
            é necessário criar uma nova solicitação, na qual se encontra ao fim da página de solicitação.
        </p><br>
        <img src="{{ URL::asset('gifs/newsolicity.gif') }}" />

        <br><br>

        <p style="font-size: 16px;">
            A nova solicitação deve informar o local de Destino da solicitação anterior como <b>Local de Origem</b> e
            informar a<br>
            segunda localização como o segundo <b>Local de Destino</b>.<br><br>
            Ex.: <br>
            A Solicitação requer passar na SESA e ir até o LACEN. Seguindo, a solicitação ficará dá seguinte maneira
            <br><br>
            <b>Origem:</b> HSJ &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino:</b> SESA<br><br>
            <b>Origem:</b> SESA &nbsp;&nbsp;<b>-</b>&nbsp;&nbsp; <b>Destino:</b> LACEN<br>
        </p><br>
        <img src="{{ URL::asset('gifs/newsolicity2.gif') }}" />

        <br><br>

        <p style="font-size: 16px;">Após informar os endereços, seguir o mesmo passo da solicitação anterior,<br> passando as informações que serão
            utilizadas no segundo local <b>(Finalidade, Data e Hora)</b>. <br> Após tudo verificado e preenchido, Solicitar Veiculo,
            ou adicionar outra solicitação.
        <p><br>

            <!-- /SOLICITAÇÃO -->

    </fieldset>
@stop
