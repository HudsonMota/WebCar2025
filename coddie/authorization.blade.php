@extends('layouts.application')

@section('content')

<h1 class="ls-title-intro ls-ico-user-add">Criar roteiro</h1>
<div class="col-md-12">
  <div class="col-md-6">
    <div class="ls-box">
      <h5 class="ls-title-5"><?php echo DB::table('vehiclerequests')->where('statussolicitacao', 'PENDENTE')->count(); ?> - Solicitações pendentes</h5>
      <hr>
      <table class="ls-table ls-table-striped ls-bg-header">
        <thead>
          <tr>
            <th>Número</th>
            <th>Solicitante - Setor</th>
            <th>Origem - Destino</th>
            <th>Saída</th>
          </tr>
        </thead>
        <tbody id="DivOrigem" ondrop="drop(event)" ondragover="allowDrop(event)">
          @foreach ($vehiclerequests as $vehiclerequest)
          <tr id="item[<?php echo $vehiclerequest->id ?>]" draggable="true" ondragstart="drag(event)">
            <td>{{$vehiclerequest->id}}</td>
            <td>{{$vehiclerequest->solicitante}} -
              @inject('sectors', '\App\Sector')
              @foreach($sectors->getSectors() as $sectors)
              @if($sectors->cc === $vehiclerequest->setorsolicitante)
              {{ $sectors->sector }}
              @endif
              @endforeach
            </td>
            <td>{{$vehiclerequest->origem}} - {{$vehiclerequest->destino}}</td>
            <td>
              <?php echo date("d/m/Y", strtotime($vehiclerequest->datasaida)) ?>
              <?php echo date("H:m", strtotime($vehiclerequest->horasaida)) ?>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <nav aria-label="...">
      <ul class="pagination pagination-sm justify-content-end">
        <li class="page-item" aria-current="page">{{ $vehiclerequests->links() }}</li>
      </ul>
    </nav>
  </div>
  <div class="col-md-6">
    <div class="ls-box">
      <b class="ls-title-5">Roteiro<a href="/authorization-add" style="display: relative; margin-left:500px;" class="ls-ico-spinner ls-btn-primary-danger"> Desfazer</a href="#"></b>
      <hr>
      <table class="ls-table ls-table-striped ls-bg-header">
        <thead>
          <tr>
            <th>Número</th>
            <th>Solicitante - Setor</th>
            <th>Origem - Destino</th>
            <th>Saída</th>
          </tr>
        </thead>
        <tbody id="DivDestino" ondrop="drop(event)" ondragover="allowDrop(event)">
        </tbody>
      </table>
      <br />
    </div>
  </div>
</div>
<style>
</style>
<script>
  function allowDrop(ev) {
    ev.preventDefault();
  }

  function drag(ev) {
    ev.dataTransfer.setData("Text", ev.target.id);
  }

  function drop(ev) {
    var data = ev.dataTransfer.getData("Text");
    ev.target.appendChild(document.getElementById(data));
    ev.preventDefault();
  }
</script>

@stop