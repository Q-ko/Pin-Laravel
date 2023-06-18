<?php

namespace App\Mail;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPostNewClient extends Mailable
{

     use Queueable, SerializesModels;

     public $cliente;


     public function __construct($cliente)
     {
          $this->cliente = $cliente;
     }

     public function build()
     {

          return $this->view('mail.registroCliente')
               ->subject('Nuevo cliente')
          ;
     }










}