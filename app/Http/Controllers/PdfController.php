<?php

namespace App\Http\Controllers;

use App\Authorizacao;
use App\Expense;
use App\Sector;
use App\Adress;
use Illuminate\Http\Request;
use \App\Solicitacao;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfController extends Controller
{
  public function gerarPdf($id)
  {

    $solicitacao = Solicitacao::where('id', '>', 0)->where('id', 'like', $id)->get();
    $authorization = Authorizacao::where('itinerary', $solicitacao[0]->grouprequest)->get();
    $drivers = DB::table('drivers')->get();
    $adress = Adress::all('acronym');

    return View('request-vehicle-pdf', compact('solicitacao',  $solicitacao), compact('authorization',  $authorization), compact('adress',  $adress));

    // return $pdf->setPaper('a4')->stream('Solicitação.pdf');
  }

  public function gerarPdf1($id)
  {
    $authorizacao = Authorizacao::where('id', '>', 0)->where('id', 'like', $id)->get();
    $solicitacoes = Solicitacao::where('grouprequest', $authorizacao[0]->itinerary)->get();

    return View('authorization-pdf', compact('authorizacao'), compact('solicitacoes'));
    // return $updf->setPaper('a4')->stream('Autorização.pdf');

  }
}
