<!DOCTYPE html>
<html lang="en">

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/pdfreq.css') }}">
</head>

<body>

    @foreach ($solicitacao as $solicitacao)
        <div class="container">
            <div class="header">
                <div class="row align-items-center">
                    <div class="col">
                        <!--IMAGENS-->
                        <div class="logo">
                            <img class="imgLogo" src="{{ asset('images/logo.png') }}" />
                        </div>
                    </div>
                    <div class="col">
                        <!--IMAGENS-->
                        <div class="logo">
                            <img class="imgLogo" src="{{ asset('images/LogoHSJ.png') }}" />
                        </div>
                    </div>
                    <div class="col">
                        <!--STATUS-->
                        <p style="font-weight: bold; font-size: 1.1em;">
                            Nº: {{ $solicitacao->id }} <br>
                            <span>Status: <br></span>
                            @if ($solicitacao->statussolicitacao == 'AUTORIZADA')
                                <span style="color: green;"> {{ $solicitacao->statussolicitacao }}</span>
                            @elseif($solicitacao->statussolicitacao == 'PENDENTE')
                                <span style="color: red;"> {{ $solicitacao->statussolicitacao }}</span>
                            @elseif($solicitacao->statussolicitacao == 'REALIZADO')
                                <span style="color: aquamarine;"> {{ $solicitacao->statussolicitacao }}</span>
                            @elseif($solicitacao->statussolicitacao == 'NÃO REALIZADO')
                                <span style="color: blue;"> {{ $solicitacao->statussolicitacao }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <br>
            <div class="body text-center">
                <div id="request">
                    <h2>SISTEMA DE GESTÃO DE FROTA</h2><br>
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 1000px; background-color: #c6c6c6;">
                                    <h5>SOLICITAÇÃO DE VEÍCULOS OFICIAIS</h5>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 500px; height:40px;">Setor Solicitante</th>
                                <th style="width: 500px; height:40px;">Nome do solicitante</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td style="font-size: 16px; height:40px;">&nbsp;
                                    @inject('sectors', '\App\Sector')
                                    @foreach ($sectors->getSectors() as $sector)
                                        @if ($solicitacao->setorsolicitante === $sector->cc)
                                            {{ $sector->sector }}
                                        @endif
                                    @endforeach
                                </td>

                                <td style="font-size: 16px; height:40px;">&nbsp;

                                    @inject('users', '\App\User')

                                    <?php
                                    
                                    $testeSolicitante = $solicitacao->solicitante;
                                    
                                    if ($testeSolicitante < Str::length(3)) {
                                        echo $testeSolicitante;
                                    } else {
                                        foreach ($users->getUsers() as $usuario) {
                                            if ($testeSolicitante == $usuario->id) {
                                                echo "$usuario->id - $usuario->name";
                                            }
                                        }
                                    }
                                    
                                    ?>

                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 700px; height:40px;">Roteiro</th>
                                <th style="width: 300px; height:40px;">Saída</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 16px;">
                                    <b style="margin-left:-10px;">ORIGEM: </b> &nbsp;
                                    @inject('adress', '\App\Adress')
                                    @foreach ($adress->getAdresses() as $adresses)
                                        @if ($solicitacao->origem === $adresses->slug_adress)
                                            {{ $adresses->acronym }} - {{ $adresses->slug_adress }}<br>
                                        @endif
                                    @endforeach
                                    <b style="margin-left:-22px;">DESTINO: </b> &nbsp;
                                    @inject('adress', '\App\Adress')
                                    @foreach ($adress->getAdresses() as $adresses)
                                        @if ($solicitacao->destino === $adresses->slug_adress)
                                            {{ $adresses->acronym }} - {{ $adresses->slug_adress }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td style="font-size: 16px;">
                                    <b>Data: </b>{{ date('d/m/Y', strtotime($solicitacao->datasaida)) }}<br>
                                    <b style="margin-left: -22px;">Hora:
                                    </b>{{ date('H:i:s', strtotime($solicitacao->horasaida)) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div id="goal">
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 1000px; background-color: #c6c6c6;">
                                    <h5>FINALIDADE</h5>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td style="width: 500px; height:40px;"> &nbsp;
                                    ( @if ($solicitacao->unidade === null)
                                        &nbsp;
                                    @else
                                        <b>x</b>
                                    @endif )Transporte de paciente&nbsp;&nbsp;
                                    ( @if ($solicitacao->materiaisfin === null)
                                        &nbsp;
                                    @else
                                        <b>x</b>
                                    @endif )Transporte de materiais&nbsp;&nbsp;
                                    ( @if ($solicitacao->admfin === null)
                                        &nbsp;
                                    @else
                                        <b>x</b>
                                    @endif )Necessidades administrativas&nbsp;&nbsp;
                                </td>
                            </tr>
                        </tbody>

                        @if ($solicitacao->unidade !== null)
                            <tbody>
                                <tr>
                                    <td style="width: 500px; height:40px;">

                                        <ul style="list-style: none;">

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Alta')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif)
                                                Alta
                                            </li>

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Transferência')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif )
                                                Transferência
                                            </li>

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Remoção')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif )
                                                Remoção
                                            </li>

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Exame com retorno')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif )
                                                Exame com retorno
                                            </li>

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Exame sem retorno')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif )
                                                Exame sem retorno
                                            </li>

                                            <li>
                                                &nbsp;( @if ($solicitacao->sltmotivo != 'Outro')
                                                    &nbsp;
                                                @else
                                                    <b>x</b>
                                                @endif )
                                                Outro
                                            </li>

                                        </ul>
                                    </td>
                                    <td style="width: 500px; height:40px;">
                                        <p>
                                            <b>Unidade: </b>{{ $solicitacao->unidade }} <br>
                                            <b>Leito: </b>{{ $solicitacao->leito }} <br>
                                            <b>Motivo da solicitação: </b>{{ $solicitacao->sltmotivo }} <br>
                                            <b>Estado: </b>{{ $solicitacao->estadopaciente }}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody>
                                <tr>
                                    @if ($solicitacao->materiaisfin !== null && $solicitacao->admfin === null)
                                        <td style="width: 500px; height:40px;">
                                            &nbsp;<b>DESCRIÇÃO: &nbsp;&nbsp;</b>
                                            {{ $solicitacao->materiaisfin }}
                                        </td>
                                    @elseif($solicitacao->materiaisfin === null && $solicitacao->admfin !== null)
                                        <td style="width: 500px; height:40px;">
                                            &nbsp;<b>DESCRIÇÃO: &nbsp;&nbsp;</b>
                                            {{ $solicitacao->admfin }}
                                        </td>
                                    @endif
                                </tr>
                            </tbody>
                        @endif
                    </table>





                    <!-- -----------  -->

                    @if ($solicitacao->statussolicitacao != 'PENDENTE')
                        <br>
                        <table class="table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th style="width: 1000px; background-color: #c6c6c6;">
                                        <h5>AUTORIZAÇÃO DE VEÍCULOS</h5>
                                    </th>
                                </tr>
                            </thead>
                        </table>

                        <table class="table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th style="width: 500px; height:40px;">Veículo</th>
                                    <th style="width: 500px; height:40px;">Motorista</th>
                                </tr>
                                <tr>
                                    @inject('vehicles', '\App\Vehicle')
                                    @foreach ($vehicles->getVehicles() as $vehicle)
                                        @if ($authorization[0]->vehicle == $vehicle->id)
                                            <td style="width: 500px; height:40px;">{{ $vehicle->brand }} |
                                                {{ $vehicle->model }} |
                                                {{ $vehicle->placa }}</td>
                                        @endif
                                    @endforeach

                                    @inject('drivers', '\App\Driver')
                                    @foreach ($drivers->getDrivers() as $driver)
                                        @if ($driver->id == $authorization[0]->driver)
                                            <td style="width: 500px; height:40px;">{{ $driver->name_driver }}</td>
                                        @endif
                                    @endforeach

                                </tr>
                                </tbody>
                        </table>
                </div>
                <br>
                <div>
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 1000px; background-color: #c6c6c6;">
                                    <h5>UTILIZAÇÃO DO VEÍCULO</h5>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <td style="width: 500px; height:40px;"><b>Data Saída</b></td>
                                <td style="width: 500px; height:40px;"><b>Hora Saída</b></td>
                                <td style="width: 500px; height:40px;"><b>Data Retorno</b></td>
                                <td style="width: 500px; height:40px;"><b>Hora Retorno</b></td>
                                <td style="width: 500px; height:40px;"><b>Km's Rodados</b></td>

                            </tr>
                            <tr>
                                <td style="width: 500px; height:40px; font-size: 16px;">
                                    {{ date('d/m/Y', strtotime($solicitacao->datasaida)) }}
                                </td>
                                <td style="width: 500px; height:40px; font-size: 16px;">
                                    {{ $authorization[0]->authorized_departure_time }}
                                </td>
                                <td style="width: 500px; height:40px; font-size: 16px;">
                                    {{ $authorization[0]->return_date }}
                                </td>
                                <td style="width: 500px; height:40px; font-size: 16px;">
                                    {{ $authorization[0]->return_time }}
                                </td>

                                <td style="width: 500px; height:40px; font-size: 16px;">
                                    {{ $solicitacao->mileage_traveled }}
                                </td>
                            </tr>
                            </tbody>
                    </table>
                    <br>
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 1000px; background-color: #c6c6c6;">
                                    <h5>ÁREA LOGÍSTA DOS TRANSPORTES</h5>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 500px; height:40px;">Autorizado por</th>
                                <th style="width: 500px; height:40px;">Data</th>
                                <th style="width: 500px; height:40px;">Assinatura do Motorista</th>
                                <th style="width: 500px; height:40px;">Data</th>
                            </tr>
                            <tr>
                                <td style="font-size: 16px; height:40px;">{{ $authorization[0]->authorizer }}</td>
                                <td style="font-size: 16px; height:40px;">
                                    <?php
                                    $my_datetime = $authorization[0]->updated_at;
                                    echo date('d/m/Y - H:i:s', strtotime("$my_datetime UTC"));
                                    ?>
                                </td>
                                <td style="font-size: 16px; height:40px;"></td>
                                <td style="font-size: 16px; height:40px;"></td>
                            </tr>
                            </tbody>
                    </table>
    @endif
    <br><br>
    <div class="footer">
        <img class="imgfooter" src="{{ asset('images/rodape.png') }}" />
    </div>
    </div>
    @endforeach

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>
