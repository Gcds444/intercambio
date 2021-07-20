<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Disciplina;
use App\Models\User;
use App\Service\GeneralSettings;

class email_indeferido extends Mailable
{
    use Queueable, SerializesModels;
    private $disciplina;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Disciplina $disciplina)
    {
        $this->disciplina = $disciplina;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //colocar um campo motivo
        $text = str_replace('%nome_aluno',$this->disciplina->pedido->nome,app(GeneralSettings::class)->email_indeferido);
        $text = str_replace('%disciplina',$this->disciplina->nome,$text);
        $ccint = explode(',',env('EMAILS_CCINT'));

        $to = [User::where('id',$this->disciplina->pedido->user_id)->first()->email];

        return $this->view('emails.email_indeferido')
            ->to($to)
            ->bcc($ccint)
            ->subject('Indeferimento do pedido de créditos')
            ->with([
                'text' => $text,
                'disciplina' => $this->disciplina,
            ]);
    }
}
