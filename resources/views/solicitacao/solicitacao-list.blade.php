@extends('layouts.application')

@section('content')
    <h1 class="ls-title-intro ls-ico-code">Lista de Solicitações</h1>

    @if (isset($msg))
        <div class="alert alert-success">
            {{ $msg }}
        </div>
    @endif

    @if (!$vehiclerequests)
        <div class="alert alert-danger" role="alert">
            Não há solicitações para exibir!
        </div>
    @else
        {{-- Expor variáveis de autenticação para controle de permissões --}}
        <script>
            const AUTH_USER_ID = {{ auth()->user()->id }};
            const AUTH_ROLE_ID = {{ DB::table('role_user')->where('user_id', auth()->user()->id)->value('role_id') }};
        </script>

        <table class="table table-hover" id="tabRequests">
            <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Cod</th>
                    <th>Solicitante</th>
                    <th>Setor</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Data Saída</th>
                    <th>Hora Saída</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- DataTables preencherá via AJAX --}}
            </tbody>
        </table>

        {{-- Scripts do DataTables --}}
        <script>
            console.log('Iniciando DataTable');
            $(document).ready(function() {
                $('#tabRequests').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 20,
                    ajax: '{{ route('solicitacao.data') }}',
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: 'Exportar Excel',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    page: 'current'
                                }
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            text: 'Exportar CSV',
                            exportOptions: {
                                columns: ':visible',
                                modifier: {
                                    page: 'current'
                                }
                            }
                        }
                    ],
                    columns: [{
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'solicitante',
                            name: 'solicitante'
                        },
                        {
                            data: 'setor',
                            name: 'setor'
                        },
                        {
                            data: 'origem',
                            name: 'origem'
                        },
                        {
                            data: 'destino',
                            name: 'destino'
                        },
                        {
                            data: 'datasaida',
                            name: 'datasaida'
                        },
                        {
                            data: 'horasaida',
                            name: 'horasaida'
                        },
                        {
                            data: 'statussolicitacao',
                            name: 'statussolicitacao',
                            render: function(d) {
                                let color = 'blue';
                                if (d === 'PENDENTE') color = 'red';
                                else if (d.startsWith('AUTORIZ')) color = 'green';
                                else if (d.startsWith('REALIZ')) color = 'Mediumaquamarine';
                                return '<span style="color:' + color + '; font-weight:bold;">' + d +
                                    '</span>';
                            }
                        },
                        {
                            data: 'id',
                            orderable: false,
                            searchable: false,
                            render: function(id, type, row) {
                                let btns = '';
                                switch (AUTH_ROLE_ID) {
                                    case 1:
                                        // SUPER ADM: edita sempre, exclui sempre
                                        btns +=
                                            '<a class="ls-ico-pencil ls-btn-dark mx-1" href="/solicitacao-edit/' +
                                            id + '"></a>';
                                        btns +=
                                            '<a class="ls-ico-remove ls-btn-primary-danger mx-1" href="/solicitacao/delete/' +
                                            id + '"></a>';
                                        break;
                                    case 2:
                                    case 3:
                                        // ADM e MANAGER: não edita, não exclui
                                        break;
                                    case 4:
                                        // USER REQUEST: edita se não autorizado/finalizado, nunca exclui
                                        if (!row.statussolicitacao.startsWith('AUTORIZ') && !row
                                            .statussolicitacao.startsWith('REALIZ')) {
                                            btns +=
                                                '<a class="ls-ico-pencil ls-btn-dark mx-1" href="/solicitacao-edit/' +
                                                id + '"></a>';
                                        }
                                        break;
                                }
                                // PDF disponível para todos
                                btns +=
                                    '<a class="ls-ico-windows ls-btn mx-1" href="/request-vehicle-pdf/' +
                                    id + '" target="_blank"></a>';
                                return btns;
                            }
                        }
                    ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                    }
                });
            });
        </script>
    @endif
@endsection
