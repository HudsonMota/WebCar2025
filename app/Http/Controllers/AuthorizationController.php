<?php

namespace App\Http\Controllers;

date_default_timezone_set('America/Fortaleza');

use App\Http\Requests\AuthorizeRequest;
use App\Authorizacao;
use App\Sector;
use App\Solicitacao;
use App\User;
use App\Adress;
use App\Vehicle;
use Dotenv\Result\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Rfc4122\UuidV1;
use SebastianBergmann\Environment\Console;

class AuthorizationController extends Controller
{
    // Função para exibir view de criação de roteiros
    public function index(Request $field)
    {
        $users = User::get();
        $adress = Adress::get();

        $vehiclerequests = Solicitacao::where('statussolicitacao', 'PENDENTE')->orderby('datasaida', 'desc')->paginate(10);
        return view('authorization/authorization-add', compact('vehiclerequests'), compact('users'), compact('adress'));
    }

    // Função para gravar novo roteiro      // AUTHORIZATION LIST
    public function store(Request $field)
    {

        // $teste = UuidV1::uuid4();
        // dd($teste);

        $authorizerequest = new Authorizacao();
        $authorizerequest->driver = $field['driver'];
        $authorizerequest->vehicle = $field['vehicle'];
        $authorizerequest->authorized_departure_date  = $field['datasaidaautorizada'];
        $authorizerequest->authorized_departure_time = $field['horasaidaautorizada'];

        //JUSTIFICATIVA
        $authorizerequest->justificativa = $field['justificativa'];

        if (is_null($field['kmfinal'])) {
        } else {
            $authorizerequest->return_date  = $field['dataretorno'];
            $authorizerequest->return_time = $field['horaretorno'];
            $authorizerequest->output_mileage  = $field['kminicial'];
            $authorizerequest->return_mileage = $field['kmfinal'];
        }
        // if ($field['kmfinal']) {
        //     $authorizerequest->return_date  = $field['dataretorno'];
        //     $authorizerequest->return_time = $field['horaretorno'];
        //     $authorizerequest->output_mileage  = $field['kminicial'];
        //     $authorizerequest->return_mileage = $field['kmfinal'];
        // }



        // Salva o usuário logado que está autorizando o roteiro
        $authorizerequest->authorizer = Auth::user()->name;

        $authorizerequest->statusauthorization = 'AUTORIZADO';      //TYPE ENUM

        // Pega a string contendo os Id's das solicitações selecionadas e converte em um array
        $selectrequestsarray = $field['selectrequestsarray']; //"101, 102, 103"
        $selectrequestexplode = explode(",", $selectrequestsarray); //"[101, 102, 103]"

        // Identificador de roteiro
        $date = date("d-m-Y");
        $time = date("H:i:s");
        $cod = md5(uniqid(rand(), true));
        $cod_group = $date . "_" . $time . "_" . $cod;


        // $cod_group = UuidV1::uuid4();        gera o identificador do roteiro

        // A partir do array $selectrequestexplode, cada solicitação receberá um novo update
        for ($i = 0; $i < count($selectrequestexplode); $i++) {
            // Salva um código identificador de roteiro
            DB::table('vehiclerequests')
                ->where('id', $selectrequestexplode[$i])
                ->update(
                    [
                        'grouprequest' => $cod_group,
                        'statussolicitacao' => "AUTORIZADA",
                    ]
                );
        }

        $authorizerequest->arr_requests_in_script = $selectrequestsarray;

        $authorizerequest->itinerary = $cod_group;
        if ($selectrequestsarray) {
            $authorizerequest->save();

            return redirect()->route('authorizations');
        } else {
            return redirect()->back()->with('error', 'Não é possível criar roteiro vazio! Por favor adcione uma solicitação ao roteiro.');
        }
    }

    // Função para visualizar dados da VIEW /authorizations
    public function list_authorizations()
    {
        // // Retorna os setores
        $sectors = DB::table('sectors')->get();

        // Retorna os roteiros em ordem decrescente
        $scriptsauthorizeds = DB::table('authorizerequests')->orderBy('id', 'desc')->paginate(10);

        // // Retorna os veículos
        $vehicles = DB::table('vehicles')->get();

        // // Retorna os motoristas
        $drivers = DB::table('drivers')->get();

        return view('authorization/authorization-list', compact('scriptsauthorizeds', 'sectors', 'vehicles', 'drivers'));
    }

    // Função para exbir view de edição de formulário
    public function get_edit_authorization($id)
    {
        $users = User::get();
        $scriptauthorized = Authorizacao::find($id);
        $vehiclerequests = Solicitacao::where('statussolicitacao', '=', 'PENDENTE')->orderby('created_at', 'desc')->paginate(10);

        $itinerary = $scriptauthorized->itinerary;
        $grouprequestsauth = Solicitacao::where('grouprequest', '=', $itinerary)->orderby('created_at', 'desc')->get();

        return view('authorization/authorization-edit', compact('vehiclerequests', 'scriptauthorized', 'grouprequestsauth', 'users'));
    }

    // Função para editar informações
    public function post_edit_authorization(Request $info, $id)
    {
        $authorizerequest = Authorizacao::find($id);

        // Este trecho insere nulo no campo grouprequest da tabela de solicitações
        // a partir do roteiro informado
        DB::table('vehiclerequests')
            ->where('grouprequest', $authorizerequest->itinerary)
            ->update(
                [
                    'grouprequest' => null,
                    'statussolicitacao' => "PENDENTE",
                ]
            );

        $authorizerequest->driver = $info['driver'];
        $authorizerequest->vehicle = $info['vehicle'];
        $authorizerequest->authorized_departure_date  = $info['datasaidaautorizada'];
        $authorizerequest->authorized_departure_time = $info['horasaidaautorizada'];

        // Salva o usuário logado que está autorizando o roteiro
        $authorizerequest->authorizer = Auth::user()->name;

        $authorizerequest->statusauthorization = 'AUTORIZADO';

        // Pega a string contendo os Id's das solicitações selecionadas e converte em um array
        $selectrequestsarray = $info['selectrequestsarray'];
        $selectrequestexplode = explode(",", $selectrequestsarray);

        // Cria uma string unica para Identificador de roteiro
        $date = date("d-m-Y");
        $time = date("H:i:s");
        $cod = md5(uniqid(rand(), true));
        $cod_group = $date . "_" . $time . "_" . $cod;

        // A partir do array $selectrequestexplode, cada solicitação receberá um novo update
        for ($i = 0; $i < count($selectrequestexplode); $i++) {
            // Salva um código identificador de roteiro
            DB::table('vehiclerequests')
                ->where('id', $selectrequestexplode[$i])
                ->update(
                    [
                        'grouprequest' => $cod_group,
                        'statussolicitacao' => "AUTORIZADA",
                    ]
                );
        }

        $authorizerequest->arr_requests_in_script = $selectrequestsarray;

        $authorizerequest->itinerary = $cod_group;

        if ($selectrequestsarray) {
            $authorizerequest->save();

            return redirect()->route('authorizations');
        } else {
            DB::table('authorizerequests')
                ->where('id', $authorizerequest->id)
                ->delete();
            return redirect()->route('authorizations')->with('error', 'Não é possível criar roteiro vazio! Por favor adcione uma solicitação ao roteiro.');
        }
    }

    // Função para finalizar roteiro
    function end_script(Request $info)
    {
        // Identificando o roteiro a ser finalizado
        $authorizerequest = Authorizacao::find($info['id']);

        // Salvando informações do formulário
        $authorizerequest->return_date = $info['dataretorno'];
        $authorizerequest->return_time = $info['horaretorno'];
        $authorizerequest->output_mileage   = $info['kminicial'];
        $authorizerequest->return_mileage = $info['kmfinal'];
        $authorizerequest->authorizer = Auth::user()->name;
        $authorizerequest->statusauthorization = "REALIZADO";

        //JUSTIFICATIVA
        $authorizerequest->justificativa = $info['justificativa'];

        // Caso mutiplas roteiros variável pegará a string que registra os ids das solicitações
        // $authorizerequest->arr_requests_in_script e fará um explode() para transformará em array
        $arr_requests_in_script = explode(',', $authorizerequest->arr_requests_in_script);

        // FOR na quantidade de itens do array
        for ($i = 0; $i < count($arr_requests_in_script); $i++) {
            // Pega cada id de solicitação 
            // e passa os endereços de origem e destino para suas respectivas arrays
            $addressRqOrigem[$i] = DB::table('vehiclerequests')->where('id', $arr_requests_in_script[$i])->get('origem');
            $addressRqDestino[$i] = DB::table('vehiclerequests')->where('id', $arr_requests_in_script[$i])->get('destino');

            // Buscando setor solicitante com base no array de id de solicitações do roteiro
            $sector_id[$i] = DB::table('vehiclerequests')->where('id', $arr_requests_in_script[$i])->get('setorsolicitante');
        }


        // Calcula a distancia percorrida com base na quilometragem inicial e final fornecida pelo motorista
        $distance_script = $info['kmfinal'] - $info['kminicial'];

        // Calcula uma estimativa da distacia em quilometros por meio da função consultDBAdres()
        // Os parametros são o endereço de oriegem e destino de cada solicitação
        // O retorno é um arrray com a estimativa da distancia em quilometros de todas as solicitações do roteiro
        $distances = consultDBAdres($addressRqOrigem, $addressRqDestino);

        // A função array_unique() retira os valores iguais, array_sum() e soma o que ficou, 
        // divide por mil e multiplica por 2 para contabilizar a quilometragem de retorno a unidade. 
        $estimated_mileage = array_sum(array_unique($distances, SORT_REGULAR)) / 1000 * 2;

        for ($i = 0; $i < count($distances); $i++) {
            // Calcula a porcentagem de cada solicitação com base na estimativa
            $percentRq[$i] = ($distances[$i]  / 1000 * 2) / $estimated_mileage;
            // Pega a porcentagem da distancia total real percorrida para cada solicitação com base na porcentagem anterior
            $totalToRq[$i] = $percentRq[$i] * $distance_script;
        }

        $there_is_expense = DB::table('expenses')
            ->where('vehicle_id', '=', $authorizerequest->vehicle)
            ->where('category_id', '=', 1)
            ->orderBy('id', 'desc')->first();

        // dd($there_is_expense);

        if ($there_is_expense === null) {
            $kilometers_per_liter  = DB::table('vehicles')->where('id', $authorizerequest->vehicle)->first('kilometers_per_liter');
            $last_price = DB::table('vehicles')->where('id', $authorizerequest->vehicle)->first('last_price');
        } else {
            $kilometers_per_liter  = DB::table('expenses')->where('vehicle_id', $authorizerequest->vehicle)->where('category_id', '=', 1)->orderBy('id', 'desc')->first('kilometers_per_liter');
            $last_price = DB::table('expenses')->where('vehicle_id', $authorizerequest->vehicle)->where('category_id', '=', 1)->orderBy('id', 'desc')->first('cost_per_liter');
        }

        // Geração de custos com combutivel
        for ($i = 0; $i < count($totalToRq); $i++) {
            // dd($last_price->cost_per_liter);
            DB::table('fuel_costs')->insert(
                [
                    'request_id' => $arr_requests_in_script[$i],
                    'group_script' => $authorizerequest->itinerary, // Código do roteiro
                    'vehicle_id' => $authorizerequest->vehicle, //Veículo
                    'sector_id' => $sector_id[$i][0]->setorsolicitante, //Necessário para verificar quanto cada setor consumiu em KM
                    'individual_km' => $totalToRq[$i], //Custo total em KM para cada setor
                    'percet' => $percentRq[$i], //porcentagem em relação ao total real percorrido do roteiro
                    'individual_liter' => $totalToRq[$i] / $kilometers_per_liter->kilometers_per_liter, //litros por viagem
                    'individual_spent' => ($totalToRq[$i] / $kilometers_per_liter->kilometers_per_liter) * $last_price->cost_per_liter, //valor pago
                    'date' => $info['dataretorno'], //Mater data de finalização do roteiro
                    'time' => $info['horaretorno'], //Mater hora de finalização do roteiro
                    'created_at' => $info['dataretorno'] . ' ' . $info['horaretorno'], //Gerado automáticamente
                    'updated_at' => $info['dataretorno'] . ' ' . $info['horaretorno'], //Gerado automáticamente
                ]
            );
        }

        for ($i = 0; $i < count($arr_requests_in_script); $i++) {
            Solicitacao::where('grouprequest', $authorizerequest->itinerary)
                ->where('id', $arr_requests_in_script[$i])
                ->update(
                    [
                        'mileage_traveled' => $totalToRq[$i],
                        'statussolicitacao' => "REALIZADO",
                        'created_at' => $info['dataretorno'] . ' ' . $info['horaretorno'], //Gerado automáticamente
                        'updated_at' => $info['dataretorno'] . ' ' . $info['horaretorno'], //Gerado automáticamente
                    ]
                );
        }

        // dd($authorizerequest);
        $authorizerequest->save();


        return redirect()->route('authorizations');
    }

    // Função deletar Autorização
    public function delete_authorization($id)
    {
        $authorizerequest = Authorizacao::find($id);

        Solicitacao::where('grouprequest', $authorizerequest->itinerary)
            ->update(
                [
                    'grouprequest' => null,
                    'statussolicitacao' => "PENDENTE",
                ]
            );

        $authorizerequest->delete();
        return redirect()->back();
    }
}

// Função que retorna um arrray com a estimativa da distancia em quilometros de todas as solicitações do roteiro
// Recebe arrais de origem e destino
function consultDBAdres($addressRqOrigem, $addressRqDestino): array
{
    // Puxa todos os endereços salvos na tabela de endereços
    $adress = DB::table('adress')->get('slug_adress');

    // FOR com a quantidade de itens na tabela de endereços
    for ($i = 0; $i < count($adress); $i++) {
        // FOR com a quantidade de itens do array de endereços de origem
        for ($j = 0; $j < count($addressRqOrigem); $j++) {
            // Verifica se o endereço bate com a tabela de enrendereços
            // Caso negativo, salva o endereço da base de dados sem acrônimo
            if (mb_strpos($addressRqOrigem[$j][0]->origem, $adress[$i]->slug_adress) !== false) {
                $ad1[$j] = $adress[$i]->slug_adress;
            } else {
                $ad1[$j] = $addressRqOrigem[$j][0]->origem;
            }
        }
    }

    // FOR com a quantidade de itens na tabela de endereços
    for ($i = 0; $i < count($adress); $i++) {
        // FOR com a quantidade de itens do array de endereços de destino
        for ($j = 0; $j < count($addressRqDestino); $j++) {
            // Verifica se o endereço bate com a tabela de enrendereços
            // Caso negativo, salva o endereço da base de dados sem acrônimo
            if (mb_strpos($addressRqDestino[$j][0]->destino, $adress[$i]->slug_adress) !== false) {
                $ad2[$j] = $adress[$i]->slug_adress;
            } else {
                $ad2[$j] = $addressRqDestino[$j][0]->destino;
            }
        }
    }



    // Caso endereço anteriormente não exista na tabela a posição vem vazia
    // Neste ponto ela é preenchida com o endereço informado
    for ($i = 0; $i < count($addressRqOrigem); $i++) {
        if (!array_key_exists($i, $ad1)) {
            $ad1[$i] = $addressRqOrigem[$i][0]->origem;
        }
    }

    for ($i = 0; $i < count($addressRqDestino); $i++) {
        if (!array_key_exists($i, $ad2)) {
            $ad2[$i] = $addressRqDestino[$i][0]->destino;
        }
    }

    // percorre os arrays de endereços de origem e destino
    for ($i = 0; $i < count($addressRqOrigem); $i++) {
        // Busca a lat e lng do endereço
        // $newaddressRqOrigem[$i] = explode(" ", $addressRqOrigem[$i][0]->origem, 2);
        $resultAdressOrigem[$i] = DB::table('adress')->where('slug_adress', $ad1[$i])->select(DB::raw('lat as lat'), DB::raw('lng as lng'))->get();
        if (count($resultAdressOrigem[$i]) == 0) {
            $resultAdressOrigem[$i][0] = returnLatLng($ad1[$i]);
        }

        // $newaddressRqDestino[$i] = explode(" ", $addressRqDestino[$i][0]->destino, 2);
        $resultAdressDestino[$i] = DB::table('adress')->where('slug_adress', $ad2[$i])->select(DB::raw('lat as lat'), DB::raw('lng as lng'))->get();
        if (count($resultAdressDestino[$i]) == 0) {
            $resultAdressDestino[$i][0] = returnLatLng($ad2[$i]);
        }
    }

    // Por meio da API Freemium trueway-matrix da rapidapi consultamos a distancia estimada em quilometros utilizando a lat e lng de cada endereço
    for ($i = 0; $i < count($resultAdressOrigem); $i++) {
        $curl[$i] = curl_init();

        curl_setopt_array($curl[$i], [
            CURLOPT_URL => "https://trueway-matrix.p.rapidapi.com/CalculateDrivingMatrix?origins=" . $resultAdressOrigem[$i][0]->lat . "%2C%20" . $resultAdressOrigem[$i][0]->lng . "&destinations=" . $resultAdressDestino[$i][0]->lat . "%2C%20" . $resultAdressDestino[$i][0]->lng . "",
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: trueway-matrix.p.rapidapi.com",
                "x-rapidapi-key: 93aee0b233msh27655e4afe508bap1e1f3cjsn5d2ff066ef84"
            ],
        ]);

        $res[$i] = curl_exec($curl[$i]);
        $err[$i] = curl_error($curl[$i]);

        curl_close($curl[$i]);

        if ($err[$i]) {
            return view('authorizations')->with('errorMsg', 'Falha de comunicação com API! Tente novamente mais tarde!');
        } else {
        }

        $response[$i] = json_decode($res[$i]);
    }

    for ($i = 0; $i < count($response); $i++) {
        $distances[$i] = $response[$i]->distances[0][0];
    }

    return $distances;
}

// Função que retorna a latitude e longitude do endereço
function returnLatLng($adresWithoutLatLng)
{
    $newAdresWithoutLatLng = str_replace(' ', '%20', $adresWithoutLatLng);

    $curl2 = curl_init();

    curl_setopt_array($curl2, [
        CURLOPT_URL => "https://trueway-geocoding.p.rapidapi.com/Geocode?address=" . $newAdresWithoutLatLng . "&language=pt-br",
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: trueway-geocoding.p.rapidapi.com",
            "x-rapidapi-key: 93aee0b233msh27655e4afe508bap1e1f3cjsn5d2ff066ef84"
        ],
    ]);

    $response2 = curl_exec($curl2);
    $err = curl_error($curl2);

    curl_close($curl2);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        // echo $response;
    }

    $res = json_decode($response2);

    return $res->results[0]->location;
}
