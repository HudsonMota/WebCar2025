@extends('layouts.application')

@section('content')

    <h1 class="ls-title-intro ls-ico-cog">Gerenciar papeis de usuários</h1>
    <div class="ls-box">
        <hr>
        <h5 class="ls-title-5">Cadastrar Papeis de usuário:</h5>
        <form method="POST" action="{{ route('roleuser.postAdd') }}" class="ls-form row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <fieldset>


                <div class="col-md-12">
                    <div class="form-group col-md-4">
                        <label class="ls-label col-md-12">
                            <b class="ls-label-text">Usuário</b>
                            <div class="ls-custom-select">
                                <select name="user_id" class="ls-select">
                                    @foreach ($read as $call)
                                        <option value="{{ $call->id }}">{{ $call->id }} - {{ $call->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="ls-label col-md-12">
                            <b class="ls-label-text">Papel</b>
                            <div class="ls-custom-select">
                                <select name="role_id" class="ls-select">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </label>
                    </div>
                    <div class="form-group col-md-4">
                        <b class="ls-label-text">Papel</b>
                        <p><strong>SUPER ADM</strong> Infraestrutura, administrador geral. Nível 1.</p>
                        <p><strong>ADM</strong> Serviços Gerais, administrador de frota. Nível 2.</p>
                        <p><strong>MANAGER</strong> Gestores Administrativos, ADM Financeiro, ADM Custos, etc. Nível 3.</p>
                        <p><strong>PAD</strong>Programa de atendimento Domiciliar</p>
                        <p><strong>USER REQUEST</strong> Gestores de setor ou responsáveis autorizados, responsáveis por
                            solicitar frota. Nível 4</p>
                        <p><strong>NO ROLE</strong> Usuário sem permissões</p>
                    </div>
                </div>


            </fieldset>
            <div class="ls-actions-btn" style="border-top-color: rgba(255,255,255);">
                <input type="submit" value="Cadastrar" class="ls-btn-primary" title="Cadastrar" style="font-weight: bold;">
                <input type="reset" value="Limpar" class="ls-btn-primary-danger" sstyle="font-weight: bold;">
            </div>
        </form>

    </div>

@stop
