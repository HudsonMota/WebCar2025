@extends('layouts.application')

@section('content')

<html>

<head>
    <title>Controle Veiculos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>

<body>
    <h1 class="ls-title-intro ls-ico-chart-bar-up">Gráficos e indicadores</h1>

    <div class="ls-box ls-board-box">
        <header class="ls-info-header">
            <h2 class="ls-title-3">Esta página está em desenvolvimento...</h2>

        </header>

        <form method="post" action="{{ route('chart.list') }}" class="form form-inline" style="margin-bottom: 10px;">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <fieldset>
                <label class="ls-label col-md-12">
                    <div class="col-md-10">
                        <input type="text" name="situacao" placeholder="Situação">
                    </div>
                    <div class="col-col-md-3">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                </label>
            </fieldset>
        </form>  

        <table class="ls-table ls-table-striped">
    <thead>
      <tr>
        <th>Veículo</th>
        <th>Categoria</th>
        <th>Quilometragem atual(Km)</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($spred as $spred)
          <tr>
            <td>{{$spred->brand}} {{$spred->model}} - {{$spred->placa}}</td>
            @inject('categories', \App\Category)
            @foreach($categories->getCategories() as $category)
              @if($category->id == $spred->category_id)
              <td>{{$category->name}}</td>
              @endif
            @endforeach
          </tr>
      @endforeach
    </tbody>
  </table>

    </div>
</body>

</html>
@stop