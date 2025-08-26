<!-- ################################# H O M E ############################################# -->
@extends('layouts.application')

@section('content')
  <?php
    $name = substr(Auth::user()->name, 0, strrpos(substr(Auth::user()->name, 0, 20), ' '));
  ?>
<h1 class="ls-title-intro ls-ico-home">Olá {{ $name }}! Seja bem vindo ao WebCar HSJ</h1>

<div class="ls-box ls-board-box">
  <header class="ls-info-header card-footer">
    <h2 class="ls-title-3">Dashboard Mês Atual: {{date('m/Y')}}</h2>

  </header>

    <!-- Veiculos Cadastrados -->
    @can('View ADM dashboard')
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: #00BFFF;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">VEICULOS CADASTRADOS</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Vehicle::count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
            <form method="post" action="{{ route('vehicle.list') }}" class="form form-inline">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <fieldset>
              </fieldset>
              <button type="submit" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endcan

    <!-- Veículos em Manutenção   -->
    @can('View ADM dashboard')
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: 	#CD853F;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Veículos em Manutenção</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Vehicle::where('situacao', 'MANUTENÇÃO')->count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
            <form method="post" action="{{ route('vehicle.list') }}" class="form form-inline">
              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              <fieldset>
                <label class="ls-label col-md-12">
                  <input type="text" name="situacao" value="MANUTENÇÃO" style="display: none;">
                </label>
              </fieldset>
              <button type="submit" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto;color: #000; font-weight: bold;">Exibir</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endcan

    <!-- Motoristas Cadastrados -->
    @can('View ADM dashboard')
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: 		#48D1CC;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Motoristas Cadastrados</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Driver::all()->count()-1 }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
            <a href="{{ route('drivers') }}" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto;color: #000; font-weight: bold;">Exibir</a>
          </div>
        </div>
      </div>
    </div>
    @endcan

    <!-- Suas Solicitações Pendentes -->
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: #C64B4D;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Suas Solicitações Pendentes</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Solicitacao::where('statussolicitacao', 'PENDENTE')
                      ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
                      ->where('solicitante', auth()->user()->id)->count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
              <a href="{{ route('solicitacoes.pendentes') }}" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Autorizações Pendentes -->
    @can('View ADM dashboard')
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: #F7293D;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Autorizações Pendentes</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Solicitacao::where('statussolicitacao', 'PENDENTE')
              ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
              ->count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
              <a href="{{ route('authorizations') }}" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</a>
          </div>
        </div>
      </div>
    </div>
    @endcan

    <!-- Viagens realizadas -->
    @can('View ADM dashboard')
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: #87CEFA;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Viagens realizadas</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Authorizacao::where('statusauthorization', 'REALIZADO')
              ->where('authorized_departure_date', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
              ->count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
              <a href="{{ route('authorizations') }}" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</a>
          </div>
        </div>
      </div>
    </div>
    @endcan

    <!-- Suas viagens realizadas -->
    <div class="col-sm-6 col-md-3 dash">
      <div class="ls-box" style="background-color: 	#00BFFF;">
        <div class="ls-box-head">
          <h6 class="ls-title-4" style="color: #000; font-weight: bold;">Suas viagens realizadas</h6>
        </div>
        <div class="ls-box-body">
          <strong>{{ App\Solicitacao::where('statussolicitacao', 'REALIZADO')
                      ->where('datasaida', '>', date('Y-m-d', mktime(0, 0, 0, date('m') , 1 , date('Y'))))
                      ->where('solicitante', auth()->user()->id)->count() }}</strong>
        </div>
        <div class="ls-box-footer">
          <div class="box-header">
              <a href="{{ route('solicitacoes.realizadas') }}" class="btn btn-light" style="width: 150px; margin-left: auto; margin-right: auto; color: #000; font-weight: bold;">Exibir</a>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="ls-box card-footer" style="margin-top: -21px;">
    <h5 style="margin-top: 8px; margin-bottom: 8px;">
      Não entende como prosseguir?&nbsp;&nbsp;&nbsp; Veja o <a href="/informacao/tutorial" style="font-size: 25px; text-decoration: none;">Tutorial do Sistema</a>
    </h5>
  </div>
@endsection