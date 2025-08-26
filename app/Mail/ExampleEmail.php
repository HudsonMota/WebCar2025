<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\LaravelDriver\MailerSendTrait;

class ExampleEmail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    protected $recipientEmail; // Propriedade para o e-mail do destinatário
    protected $recipientName; // Propriedade para o nome do destinatário

    public function __construct($recipientEmail, $recipientName)
    {
        $this->recipientEmail = $recipientEmail;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        return $this->view('auth.passwords.email') // Defina a view do email
            ->with([
                'name' => $this->recipientName, // Passando o nome para a view
            ])
            ->mailersend(
                null, // Template ID, se você estiver usando um template do MailerSend
                // Variáveis para personalização simples
                [
                    new Variable($this->recipientEmail, ['name' => $this->recipientName])
                ],
                // Tags
                ['tag'],
                // Adicionais para o envio
                true // precedenceBulkHeader (opcional)
            );
    }
}
