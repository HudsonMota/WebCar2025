<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/pdfreq.css') }}">
</head>

<body>

    <!--CABEÇALHO-->
    @foreach ($authorizacao as $authorizacao)
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
                            Nº: {{ $authorizacao->id }}<br>
                            <span>Status: <br></span>
                            @if ($authorizacao->statusauthorization == 'AUTORIZADO')
                                <span style="color: green;"> {{ $authorizacao->statusauthorization }}</span>
                            @elseif($authorizacao->statusauthorization == 'PENDENTE')
                                <span style="color: red;"> {{ $authorizacao->statusauthorization }}</span>
                            @elseif($authorizacao->statusauthorization == 'REALIZADO')
                                <span style="color: aquamarine;"> {{ $authorizacao->statusauthorization }}</span>
                            @elseif($authorizacao->statusauthorization == 'NÃO REALIZADO')
                                <span style="color: blue;"> {{ $authorizacao->statusauthorization }}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!--BODY-->
            <div class="body text-center">
                <div id="request">
                    <h2>SISTEMA DE GESTÃO DE FROTA</h2>
                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 1000px; background-color: #c6c6c6;">
                                    <h5>AUTORIZAÇÃO DE SAÍDAS</h5>
                                </th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 100px; height:40px;">ID</th>
                                <th style="width: 300px; height:40px;">Setor Solicitante</th>
                                <th style="width: 800px; height:40px;">Origem</th>
                                <th style="width: 800px; height:40px;">Destino</th>
                                <th style="width: 200px; height:40px;">Quilometros Percorridos</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solicitacoes as $solicitacao)
                                <tr>
                                    <td style="font-size: 16px;">{{ $solicitacao->id }}</td>

                                    @inject('sectors', '\App\Sector')

                                    @foreach ($sectors->getSectors() as $sector)
                                        @if ($solicitacao->setorsolicitante === $sector->cc)
                                            <td style="font-size: 15px; height:40px;">{{ $sector->cc }} -
                                                {{ $sector->sector }}
                                            </td>
                                        @endif
                                    @endforeach

                                    <td style="font-size: 14px; height:40px;">
                                        @inject('adress', '\App\Adress')
                                        @foreach ($adress->getAdresses() as $adresses)
                                            @if ($solicitacao->origem === $adresses->slug_adress)
                                                {{ $adresses->acronym }} - {{ $adresses->slug_adress }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="font-size: 14px; height:40px;">
                                        @inject('adress', '\App\Adress')
                                        @foreach ($adress->getAdresses() as $adresses)
                                            @if ($solicitacao->destino === $adresses->slug_adress)
                                                {{ $adresses->acronym }} - {{ $adresses->slug_adress }}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="font-size: 14px; height:40px;">
                                        {{ number_format($solicitacao->mileage_traveled, 0) }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 500px; height:40px;" colspan="3">Saída</th>
                                <th style="width: 500px; height:40px;" colspan="3">Retorno</th>
                            </tr>
                            <tr>
                                <td style="width: 500px; height:40px;"><strong>Data</strong></td>
                                <td style="width: 500px; height:40px;"><strong>Hora</strong></td>
                                <td style="width: 500px; height:40px;"><strong>Km Inicial</strong></td>
                                <td style="width: 500px; height:40px;"><strong>Data</strong></td>
                                <td style="width: 500px; height:40px;"><strong>Hora</strong></td>
                                <td style="width: 500px; height:40px;"><strong>Km Final</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ date('d/m/Y', strtotime($authorizacao->authorized_departure_date)) }}
                                </td>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->authorized_departure_time }}</td>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->output_mileage }}</td>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->return_date }}</td>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->return_time }}</td>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->return_mileage }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>

                <div id="authorized">
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
                                <th style="width: 825px; height:40px;">Veículo</th>
                                <th style="width: 500px; height:40px;">Motorista</th>
                                <th style="width: 200px; height:40px;">Total percorrido(Km)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @inject('vehicles', '\App\Vehicle')
                                @foreach ($vehicles->getVehicles() as $vehicle)
                                    @if ($authorizacao->vehicle == $vehicle->id)
                                        <td style="height:40px; font-size: 15px;">{{ $vehicle->brand }}
                                            | {{ $vehicle->model }} | {{ $vehicle->placa }}
                                        </td>
                                    @endif
                                @endforeach

                                @inject('drivers', '\App\Driver')
                                @foreach ($drivers->getDrivers() as $driver)
                                    @if ($driver->id == $authorizacao->driver)
                                        <td style="height:40px; font-size: 17px;">
                                            {{ $driver->name_driver }}</td>
                                    @endif
                                @endforeach

                                <td style="height:40px; font-size: 17px;">
                                    <?php
                                    $total = $authorizacao->return_mileage - $authorizacao->output_mileage;
                                    echo $total;
                                    ?>
                                </td>
                            </tr>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table-bordered border-secondary">
                        <thead>
                            <tr>
                                <th style="width: 500px; height:40px;">Autorizado por</th>
                                <th style="width: 500px; height:40px;">Data e Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 500px; height:40px; font-size: 17px;">
                                    {{ $authorizacao->authorizer }}</td>
                                <td style="width: 500px; height:40px; font-size: 17px;"><?php
                                $my_datetime = $authorizacao->updated_at;
                                echo date('d/m/Y - H:i:s', strtotime("$my_datetime UTC"));
                                ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>

                    <!--Justificativa-->
                    @if (is_null($authorizacao->justificativa))
                    @else
                        <table class="table-bordered border-secondary">
                            <thead>
                                <tr>
                                    <th style="width: 1000px; background-color: #c6c6c6;">JUSTIFICATIVA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="height: 580px;">{{ $authorizacao->justificativa }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                    <!--/Justificativa-->

                </div>
            </div>

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
