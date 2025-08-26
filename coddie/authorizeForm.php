<div class="col-md-12">
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('namemotorista') ls-error @enderror">
            <b class="ls-label-text">Motorista</b>
            <input type="text" class="form-control" name="namemotorista" value="{{old('namemotorista')}}">

            @error('namemotorista')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
    <!-- Injeção de Serviço -->
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12  @error('veiculo') ls-error @enderror">
            <b class="ls-label-text">Veículo</b>
            @inject('vehicles', '\App\Vehicle')
            <div class="ls-custom-select">
                <select name="veiculo" class="ls-select">
                    <option value=""></option>
                    @foreach($vehicles->getVehicles() as $vehicles)
                    <option value="{{ $vehicles->placa }}">{{ $vehicles->brand }} {{ $vehicles->model }} |
                        {{ $vehicles->placa}} | {{ $vehicles->situacao }}</option>
                    @endforeach
                </select>
            </div>

            @error('veiculo')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
    <!-- Injeção de Serviço -->
</div>

<h5 class="ls-title-5" style="margin-left: 20px;">Utilização do veículo</h5>
<hr>
<div class="col-md-12">
    <h5 class="ls-title-6">Saída</h5>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('datasaidaautorizada') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input type="date" class="form-control" name="datasaidaautorizada" placeholder="Data"
                value="{{old('datasaida')}}">

            @error('datasaidaautorizada')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>

    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('horasaidaautorizada') ls-error @enderror">
            <b class="ls-label-text">Hora</b>
            <input type="time" class="form-control" name="horasaidaautorizada" placeholder="Hora"
                value="{{old('horasaida')}}">

            @error('horasaidaautorizada')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>

</div>

<div class="col-md-12">
    <h5 class="ls-title-6">Retorno</h5>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('dataretornoautorizada') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input type="date" class="form-control" name="dataretornoautorizada" placeholder="Data"
                value="{{old('dataretorno')}}">

            @error('dataretornoautorizada')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('horaretornoautorizada') ls-error @enderror">
            <b class="ls-label-text">Hora</b>
            <input type="time" class="form-control" name="horaretornoautorizada" placeholder="Hora"
                value="{{old('horaretorno')}}">

            @error('horaretornoautorizada')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
</div>

<div class="col-md-12">
    <h5 class="ls-title-6">Quilometragem</h5>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('kminicial') ls-error @enderror">
            <b class="ls-label-text">Quilometragem Atual</b>
            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
                name="kminicial" maxlength="6" autocomplete="off" value="{{old('kminicial')}}">

            @error('kminicial')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('kmfinal') ls-error @enderror">
            <b class="ls-label-text">Quilometragem Final</b>
            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"
                name="kmfinal" maxlength="6" autocomplete="off" value="{{old('kmfinal')}}">

            @error('kmfinal')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
</div>

<div class="col-md-12">
    <h5 class="ls-title-6">Autorização</h5>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('autorizacao') ls-error @enderror">
            <b class="ls-label-text">Autorizado por</b>
            <input type="text" class="form-control" name="autorizacao" value="{{old('autorizacao')}}">

            @error('autorizacao')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
    <div class="form-group col-md-3">
        <label class="ls-label col-md-12 @error('data') ls-error @enderror">
            <b class="ls-label-text">Data</b>
            <input type="date" class="form-control" name="data" placeholder="Data" value="{{old('data')}}">

            @error('data')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group col-md-6">
        <label class="ls-label col-md-12 @error('observ') ls-error @enderror">
            <b class="ls-label-text">Obeservação</b>
            <input type="text" class="form-control" name="observ" value="{{old('observ')}}">

            @error('observ')
            <div class="ls-help-message">
                {{$message}}
            </div>
            @enderror

        </label>
    </div>
</div>