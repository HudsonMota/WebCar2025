<?php

namespace App\Http\Controllers;

use App\Mail\ExampleEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    // Método para mostrar o formulário
    public function showForm()
    {
        return view('auth.passwords.email'); // Altere para o nome correto da sua view
    }

    // Método para enviar o e-mail
    public function sendEmail(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'email' => 'required|email',
            // O campo 'name' pode ser removido se não for utilizado na view
            // 'name' => 'required|string|max:255',
        ]);

        // Defina o e-mail e o nome do destinatário a partir do Request
        $recipientEmail = $request->input('email');
        // Você pode adicionar um campo 'name' no formulário e na validação se precisar
        // $recipientName = $request->input('name');

        // Envie o e-mail
        try {
            Mail::to($recipientEmail)->send(new ExampleEmail($recipientEmail, $recipientEmail));
            return response()->json(['message' => 'E-mail enviado com sucesso!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao enviar o e-mail: ' . $e->getMessage()], 500);
        }
    }
}
