<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoticeMail extends Mailable
{
   use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
	     $this->data = $data;
    }

    public function build()
    {
        return $this->view('noticeMail')->subject('Recordatorio Cita GatiGos')->with(['data', $this->data]);
    }
}
