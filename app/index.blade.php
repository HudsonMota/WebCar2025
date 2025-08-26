@extends('layouts.application')

@section('content')
    <?php
    $name = substr(Auth::user()->name, 0, strrpos(substr(Auth::user()->name, 0, 20), ' '));
    ?>
    <h1 class="ls-title-intro ls-ico-home">Olá, {{ Auth::user()->name }}!</h1>
    <div class="ls-box ls-board-box">

        <header class="ls-info-header">
            <h2 class="ls-title-3" style="color: red;">Atenção!</h2>

        </header>

        <h3>Nenhum papel ou função foi atribuído ao seu usuário.</h3>
        <h3>Por favor, entre em contato com o administrador do sistema e solicite suas permissões.</h3>

        <h2>Ramal do Setor: 3101-2328</h2>

    </div>
@endsection
