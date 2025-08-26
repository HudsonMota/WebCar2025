@extends('layouts.application')

@section('content')
<h1 class="ls-title-intro ls-ico-code">Solicitar Veiculo</h1>

<form method="POST" action="{{ route('solicitacao.postAdd') }}" class="ls-form row" id="add" autocomplete="on">
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <fieldset id="field01">
        <div class="ls-box">
            <div class="col-md-12">
                <div class="ls-box">
                    <div class="col-md-6">
                        <h5 class="ls-title-5">Solicitante</h5>
                        <hr>
                        <div class="form-group col-md-12">
                            <b class="ls-label-text col-md-4">Nome do Solicitante</b>
                            <div class="col-md-3">
                                <b style="color: red;" class="ls-label-text">Não encontrou na lista?</b>
                                <input onchange="verifyCheck(0)" type="checkbox" id="checkSolicitante[0]" nome="subscribe" value="">
                            </div>

                            <div id="inputs[0]">
                                <select id="selectSolicitante[0]" name="solicitante[0]" class="ls-select form-control col-md-12" oninvalid="this.setCustomValidity('Selecione o usuário!')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                    <option value="" class=" form-control">Selecione na lista de usuários</option>
                                    @inject('users', '\App\User')
                                    @foreach($users->getUsers() as $users)
                                    <option value="{{$users->id}}" class=" form-control">{{$users->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <b class="ls-label-text">Setor Solicitante</b>
                            <div class="ls-custom-select">
                                <select id="setorsolicitante[0]" name="setorsolicitante[0]" class="ls-select form-control" required oninvalid="this.setCustomValidity('Selecione o setor!')" onchange="try{setCustomValidity('')}catch(e){}">
                                    <option value="" class=" form-control">--</option>
                                    @inject('sectors', '\App\Sector')
                                    @foreach($sectors->getSectors() as $sectors)
                                    <option value="{{$sectors->cc}}" class=" form-control">{{$sectors->cc}} - {{$sectors->sector}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <h5 class="ls-title-5">Seu Roteiro</h5>
                        <p>
                            Selecione o endereço conforme exemplo ao lado. Ex.: <strong>HSJ R. Nestor Barbosa, 315 - Parquelândia, Fortaleza</strong>
                            <br>
                            Ou clique no botão <strong>Pesquisar</strong> ao lado do campo caso não encontre o endereço desejado.
                        </p>
                        <hr>

                        <div class="col-md-12">
                            <div class="col-col-12"><b class="ls-label-text">Origem</b></div>
                            <div class="form-group col-md-9">
                                <div class="ls-custom-select">
                                    <select id="txtOrigem[0]" name="origem[0]" class="ls-select form-control" onchange="mapear(0)" required oninvalid="this.setCustomValidity('Selecione o endereço de origem!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <option id="awaitAddressOrigin[0]" name="awaitAddressOrigin[0]" value="" selected class=" form-control">--</option>
                                        @foreach($allAdress as $a)
                                        <option value="{{$a->slug_adress}}" class=" form-control">{{$a->acronym}} - {{$a->slug_adress}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </datalist>
                            </div>

                            <div class="col-md-3"><input type="button" value="Pesquisar" onclick="search(0, `txtOrigem[0]`, `awaitAddressOrigin[0]`)" class="ls-btn-primary"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-col-12"><b class="ls-label-text">Destino</b></div>
                            <div class="form-group col-md-9">
                                <div class="ls-custom-select">
                                    <select id="txtDestino[0]" name="destino[0]" class="ls-select form-control" onchange="mapear(0)" required oninvalid="this.setCustomValidity('Selecione o endereço de origem!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <option id="awaitAddressDestino[0]" name="awaitAddressDestino[0]" value="" selected class=" form-control">--</option>
                                        @foreach($allAdress as $a)
                                        <option value="{{$a->slug_adress}}" class=" form-control">{{$a->acronym}} - {{$a->slug_adress}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3"><input type="button" value="Pesquisar" onclick="search(0, `txtDestino[0]`, `awaitAddressDestino[0]`)" class="ls-btn-primary"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="ls-title-5">Confirme se a rota foi gerada</h5>
                        <hr>
                        <iframe id="map[0]" width="680px" scrolling="no" height="400px" frameborder="0" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?saddr=HSJ&daddr=&output=embed"></iframe>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ls-box">
                    <h5 class="ls-title-5">Finalidade</h5>
                    <hr>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm01(0)" class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Transporte de pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm02(0)" class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Transporte de materiais</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm03(0)" class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Necessidades administrativas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b class="ls-label-text">Unidade</b>
                                            <input id="unidade[0]" type="text" class="form-control" name="unidade[0]" placeholder="Ex.: Unidade D" required oninvalid="this.setCustomValidity('Informe a unidade!')" onchange="try{setCustomValidity('')}catch(e){}">
                                            <b class="ls-label-text">Leito</b>
                                            <input id="leito[0]" type="number" class="form-control" name="leito[0]" placeholder="Este campo só aceita números Ex.: 2" required oninvalid="this.setCustomValidity('Informe o leito!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        </div>
                                        <div class="form-group">
                                            <b class="ls-label-text">Motivo da solicitação</b>
                                            <div class="ls-custom-select">
                                                <select id="sltmotivo[0]" name="sltmotivo[0]" class="ls-select form-control" required>
                                                    <option value="" class=" form-control">--</option>
                                                    <option value="Alta">Alta</option>
                                                    <option value="Transferência">Transferência</option>
                                                    <option value="Remoção">Remoção</option>
                                                    <option value="Retorno">Retorno</option>
                                                    <option value="Exame com retorno">Exame com retorno</option>
                                                    <option value="Exame sem retorno">Exame sem retorno</option>
                                                    <option value="Outro">Outro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b class="ls-label-text">Condições/outros</b>
                                        <textarea id="estadopaciente[0]" placeholder="Condições de locomoção de paciente ou outros motivos da solicitação" name="estadopaciente[0]" id="" cols="75" rows="7" required oninvalid="this.setCustomValidity('Descreva as condições de locomoção de paciente ou outros motivos da solicitação!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <b class="ls-label-text">Descreva os materiais a serem transportados</b>
                                    <textarea id="materiais-fin[0]" class="form-control" rows="5" name="materiaisfin[0]" placeholder="Descreva a lista de materiais a serem transportados e se há alguma documentação assinada." disabled required oninvalid="this.setCustomValidity('Descreva os materiais a serem transferidos!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <b class="ls-label-text">Descreva o motivo da solicitação</b>
                                    <textarea id="adm-fin[0]" class="form-control" rows="3" name="admfin[0]" placeholder="Ex.: Reunião" disabled required oninvalid="this.setCustomValidity('Descreva o motivo da solicitação!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ls-box">
                    <h5 class="ls-title-5">Agendamento</h5>
                    <hr>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Data do saída</b>
                        <input type="date" class="form-control" name="datasaida[0]" value="" required oninvalid="this.setCustomValidity('Informe a data que pretende sair!')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Hora do saída</b>
                        <input type="time" class="form-control" name="horasaida[0]" value="" required oninvalid="this.setCustomValidity('Informe o horário que pretende sair!')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <h5 style="color: red;" class="ls-title-5 col-md-12">Informe uma previsão de retorno caso necessite</h5>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Data do retorno</b>
                        <input type="date" class="form-control" name="dataretorno[0]" value="">
                    </div>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Hora do retorno</b>
                        <input type="time" class="form-control" name="horaretorno[0]" value="">
                    </div>
                </div>
            </div>
        </div>
        <b id="form2"></b>
        <b id="form3"></b>
        <b id="form4"></b>
    </fieldset>

    <div style="margin-top: 10px;" class="col-md-12">
        <div class="jumbotron">
            <b id="addPassenger">
                <input id="btnIncrement1" type="button" onclick="incrementForm(), loadOptionsAutoCompleteSelect()" class="btn btn-info" style="font-weight: bold;" value="Adcionar Solicitante">
            </b>
            <b id="removePassenger"></b>
            <hr>
            <div align="right" style="font-weight: bold;">
                <input type="submit" value="Solicitar Veículo" class="ls-btn-primary" title="Solicitar" style="font-weight: bold;">
                <input class="ls-btn-primary-danger" type="reset" value="Limpar Formulário" style="font-weight: bold;">
            </div>
        </div>
    </div>
</form>

<!-- ////////////////////////////////////////// Moldais -->
<div class="ls-modal" id="registerNewAddress">
    <div class="ls-modal-large">
        <div class="ls-modal-header">
            <button data-dismiss="modal">&times;</button>
            <h4 class="ls-modal-title">Preencha todos os campos para buscarmos o endereço</h4>
        </div>
        <h6 class="alert alert-primary text-center">
            Digite as iniciais de cada palavra com letras maiúsculas<br>
            <strong>Endereço:</strong> Rua Nestor Barbosa -<strong> Bairro:</strong> Parquelândia 
        </h6>
        <div class="ls-modal-body" style="height: 250px;">
            <form action="" name="searchAddress">
                <div class="col-md-12">
                    <div class="col-md-10">
                        <b>Endereço</b>
                        <input id="publicPlace" class="col-md-12" type="text" placeholder="Exemplo: Rua Nestor Barbosa" required>
                        <div id="publicPlaceMessageError" class="ls-alert-danger"></div>
                    </div>
                    <div class="col-md-2">
                        <b>Número</b>
                        <input id="numberPoint" class="col-md-12" type="number" min="1" placeholder="Ex.: 315">
                        <div id="numberPointMessageError" class="ls-alert-danger"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <b>Bairro</b>
                        <input id="neighborhood" class="col-md-12" type="text" placeholder="Exemplo: Parquelândia" required>
                        <div id="neighborhoodMessageError" class="ls-alert-danger"></div>
                    </div>
                    <div class="col-md-6">
                        <b>Cidade</b>
                        <input id="city" class="col-md-12" type="text" placeholder="Exemplo: Fortaleza" required>
                        <div id="cityMessageError" class="ls-alert-danger"></div>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="" id="list-address"></div>
                        <div id="inputAddressMessageError" class="ls-alert-danger"></div>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <button style="margin: 10px 0;" onclick="verifyAddress()" class="btn btn-info">Pesquisar</button>
            </div>
            <div class="ls-modal-footer">
                <button style="margin: 20px 0;" onclick="dismissModal()" class="ls-btn-primary-danger ls-float-right">Fechar</button>
                <button id="btnValidator" style="margin: 20px 0;" class="ls-btn-primary">Salvar endereço</button>
            </div>
        </div>
    </div>
</div>

<div class="ls-modal" id="loader">
    <div class="ls-modal-small">
        <div class="ls-modal-body text-center" style="height: 250px;">
            <div class="loader"></div>
            <br>
            <h3>Carregando . . .</h3>
        </div>
    </div>
</div>

<script>
    // Utilizado no código incrementForm.js

    var formHTML = [];
    for (i = 1; i <= 3; i++) {
        formHTML[i] = `<div class="ls-box">
            <div class="col-md-12">
                <div class="ls-box">
                    <div class="col-md-6">
                        <h5 class="ls-title-5">Solicitante</h5>
                        <hr>
                        <div class="form-group col-md-12">
                            <b class="ls-label-text col-md-4">Nome do Solicitante</b>
                            <div class="col-md-3">
                                <b style="color: red;" class="ls-label-text">Não encontrou na lista?</b>
                                <input onchange="verifyCheck(` + i + `)" type="checkbox" id="checkSolicitante[` + i + `]" nome="subscribe" value="">
                            </div>

                            <div id="inputs[` + i + `]">
                                <select id="selectSolicitante[` + i + `]" name="solicitante[` + i + `]" class="ls-select form-control col-md-12" oninvalid="this.setCustomValidity('Selecione o usuário!')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                    <option value="" class=" form-control">Selecione na lista de usuários</option>
                                    @inject('users', '\App\User')
                                    @foreach($users->getUsers() as $users)
                                    <option value="{{$users->id}}" class=" form-control">{{$users->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <b class="ls-label-text">Setor Solicitante</b>
                            <div class="ls-custom-select">
                                <select id="setorsolicitante[` + i + `]" name="setorsolicitante[` + i + `]" class="ls-select form-control" 
                                oninvalid="this.setCustomValidity('Selecione o setor!')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                    <option value="" class=" form-control">--</option>
                                    @inject('sectors', '\App\Sector')
                                    @foreach($sectors->getSectors() as $sectors)
                                    <option value="{{$sectors->cc}}" class=" form-control">{{$sectors->cc}} - {{$sectors->sector}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <h5 class="ls-title-5">Seu Roteiro</h5>
                        <p>
                            Selecione o endereço conforme exemplo ao lado. Ex.: <strong>HSJ R. Nestor Barbosa, 315 - Parquelândia, Fortaleza</strong>
                            <br>
                            Ou clique no botão <strong>Pesquisar</strong> ao lado do campo caso não encontre o endereço desejado.
                        </p>
                        <hr>

                        <div class="col-md-12">
                            <div class="col-col-12"><b class="ls-label-text">Origem</b></div>
                            <div class="form-group col-md-9">
                                <div class="ls-custom-select">
                                    <select id="txtOrigem[` + i + `]" name="origem[` + i + `]" class="ls-select form-control" onchange="mapear(` + i + `)" required oninvalid="this.setCustomValidity('Selecione o endereço de origem!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <option id="awaitAddressOrigin[` + i + `]" name="awaitAddressOrigin[` + i + `]" value="" selected class=" form-control">--</option>
                                        @foreach($allAdress as $a)
                                        <option value="{{$a->slug_adress}}" class=" form-control">{{$a->acronym}} - {{$a->slug_adress}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </datalist>
                            </div>

                            <div class="col-md-3"><input type="button" value="Pesquisar" onclick="search(` + i + `, 'txtOrigem[` + i + `]', 'awaitAddressOrigin[` + i + `]')" class="ls-btn-primary"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-col-12"><b class="ls-label-text">Destino</b></div>
                            <div class="form-group col-md-9">
                                <div class="ls-custom-select">
                                    <select id="txtDestino[` + i + `]" name="destino[` + i + `]" class="ls-select form-control" onchange="mapear(` + i + `)" required oninvalid="this.setCustomValidity('Selecione o endereço de origem!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        <option id="awaitAddressDestino[` + i + `]" name="awaitAddressDestino[` + i + `]" value="" selected class=" form-control">--</option>
                                        @foreach($allAdress as $a)
                                        <option value="{{$a->slug_adress}}" class=" form-control">{{$a->acronym}} - {{$a->slug_adress}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3"><input type="button" value="Pesquisar" onclick="search(` + i + `, 'txtDestino[` + i + `]', 'awaitAddressDestino[` + i + `]')" class="ls-btn-primary"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                    <h5 class="ls-title-5">Confirme se a rota foi gerada</h5>
                    <p>Caso negativo, digite o endereço completo Ex.: <strong>Nome do local, Número, Rua, Bairro, Cidade</strong></p>
                        <hr>
                        <iframe 
                            id="map[` + i + `]" 
                            width="680px" 
                            scrolling="no" 
                            height="400px" 
                            frameborder="0" 
                            marginheight="0" 
                            marginwidth="0" 
                            src="https://maps.google.com/maps?saddr=HSJ&daddr=&output=embed">
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="ls-box">
                    <h5 class="ls-title-5">Finalidade</h5>
                    <hr>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm01(` + i + `)" class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home` + i + `" role="tab" aria-controls="pills-home" aria-selected="true">Transporte de pacientes</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm02(` + i + `)" class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile` + i + `" role="tab" aria-controls="pills-profile" aria-selected="false">Transporte de materiais</a>
                        </li>
                        <li class="nav-item">
                            <a onclick="enableOrDisableForm03(` + i + `)" class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact` + i + `" role="tab" aria-controls="pills-contact" aria-selected="false">Necessidades administrativas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent` + i + `">
                        <div class="tab-pane fade show active" id="pills-home` + i + `" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b class="ls-label-text">Unidade</b>
                                            <input id="unidade[` + i + `]" type="text" class="form-control" name="unidade[` + i + `]" placeholder="Ex.: Unidade D" required oninvalid="this.setCustomValidity('Informe a unidade!')" onchange="try{setCustomValidity('')}catch(e){}">
                                            <b class="ls-label-text">Leito</b>
                                            <input id="leito[` + i + `]" type="number" class="form-control" name="leito[` + i + `]" placeholder="Este campo só aceita números Ex.: 2" required oninvalid="this.setCustomValidity('Informe o leito!')" onchange="try{setCustomValidity('')}catch(e){}">
                                        </div>
                                        <div class="form-group">
                                            <b class="ls-label-text">Motivo da solicitação</b>
                                            <div class="ls-custom-select">
                                                <select id="sltmotivo[` + i + `]" name="sltmotivo[` + i + `]" class="ls-select form-control" required>
                                                    <option value="" class=" form-control">--</option>
                                                    <option value="Alta">Alta</option>
                                                    <option value="Transferência">Transferência</option>
                                                    <option value="Remoção">Remoção</option>
                                                    <option value="Retorno">Retorno</option>
                                                    <option value="Exame com retorno">Exame com retorno</option>
                                                    <option value="Exame sem retorno">Exame sem retorno</option>
                                                    <option value="Outro">Outro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <b class="ls-label-text">Condições/outros</b>
                                        <textarea id="estadopaciente[` + i + `]" placeholder="Condições de locomoção de paciente ou outros motivos da solicitação" name="estadopaciente[` + i + `]" id="" cols="75" rows="7" required oninvalid="this.setCustomValidity('Descreva as condições de locomoção de paciente ou outros motivos da solicitação!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile` + i + `" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <b class="ls-label-text">Descreva os materiais a serem transportados</b>
                                    <textarea id="materiais-fin[` + i + `]" class="form-control" rows="5" name="materiaisfin[` + i + `]" placeholder="Descreva a lista de materiais a serem transportados e se há alguma documentação assinada." disabled required oninvalid="this.setCustomValidity('Descreva os materiais a serem transferidos!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact` + i + `" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="ls-box">
                                <div class="col-md-12">
                                    <b class="ls-label-text">Descreva o motivo da solicitação</b>
                                    <textarea id="adm-fin[` + i + `]" class="form-control" rows="3" name="admfin[` + i + `]" placeholder="Ex.: Reunião" disabled required oninvalid="this.setCustomValidity('Descreva o motivo da solicitação!')" onchange="try{setCustomValidity('')}catch(e){}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="ls-box">
                    <h5 class="ls-title-5">Agendamento</h5>
                    <hr>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Data do saída</b>
                        <input type="date" class="form-control" name="datasaida[` + i + `]" value="" required oninvalid="this.setCustomValidity('Informe a data que pretende sair!')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Hora do saída</b>
                        <input type="time" class="form-control" name="horasaida[` + i + `]" value="" required oninvalid="this.setCustomValidity('Informe o horário que pretende sair!')" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                    <h5 style="color: red;" class="ls-title-5 col-md-12">Informe uma previsão de retorno caso necessite</h5>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Data do retorno</b>
                        <input type="date" class="form-control" name="dataretorno[` + i + `]" value="">
                    </div>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Hora do retorno</b>
                        <input type="time" class="form-control" name="horaretorno[` + i + `]" value="">
                    </div>
                </div>
            </div>

        </div>`;
    }
</script>

<script>
    // Utilizado no código confirmeroute.js
    var adressServ = <?php echo $adress ?>;

    var listOptions = [];
    for (var i in adressServ) {
        listOptions.push(adressServ[i].slug_adress);
    }

    regex = new RegExp('\\b' + listOptions.join("\\b|\\b") + '\\b', 'i');
    //////////////////////////////////////////////////////////////////////////
</script>

<!-- Scripts para exibir mapa, incrementar fomrulário e desabilitar inputs de Tabs -->
<script type="text/javascript" src="{{ URL::asset('js/confirmeroute.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/incrementForm.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/enableordisableform.js') }}"></script>


<script>
    function verifyCheck(range) {
        var inputs = document.getElementById("inputs[" + range + "]");
        var checkSolicitante = document.getElementById("checkSolicitante[" + range + "]");
        var inputSolicitante = `<input type="text" class="form-control col-md-12" 
                            name="solicitante[` + range + `]" id="inputSolicitante" placeholder="Digite o nome do solicitante" 
                            oninvalid="this.setCustomValidity('Informe o nome do solicitante deste roteiro!')" 
                            onchange="try{setCustomValidity('')}catch(e){}" required>`;

        var selectSolicitante = `<select id="selectSolicitante" name="solicitante[` + range + `]" class="ls-select form-control col-md-12" 
                             oninvalid="this.setCustomValidity('Selecione o usuário!')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                <option value="" class=" form-control">Selecione na lista de usuários</option>
                                @inject('users', '\App\User')
                                @foreach($users->getUsers() as $users)
                                <option value="{{$users->id}}" class=" form-control">{{$users->name}}</option>
                                @endforeach
                            </select>`;

        inputs.innerHTML = '';
        if (checkSolicitante.checked == true) {
            inputs.innerHTML = inputSolicitante;
        } else if (checkSolicitante.checked == false) {
            inputs.innerHTML = selectSolicitante;
        }
    }
</script>
@stop