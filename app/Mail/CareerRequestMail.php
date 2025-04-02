<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CareerRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $info; //dichiariamo una variabile pubblica che passeremo al costruttore

    /**
     * Create a new message instance.
     */
    //!In questa funzione (__construct()) andiamo a specificare come la classe deve gestire le informazioni dell'utente
    public function __construct($info)
    {
        
       $this->info = $info;
    }

    /**
     * Get the message envelope.
     */
    //!In questa funzione (envelope()) andiamo a inserire le informazioni riguardo i dettagli della mail(come oggetto, cc, ccn, corpo, ecc..) 
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuova richiesta di lavoro ricevuta',
        );
    }

    /**
     * Get the message content definition.
     */
    //!In questa funzione (content()andiamo a specificare a quale vista vogliamo che l'utente visualizzi quando riceve la mail
    public function content(): Content
    {
        return new Content(
            view: 'mail.career-request-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
