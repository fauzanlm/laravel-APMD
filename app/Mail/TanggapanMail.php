<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TanggapanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tanggapan;
    public $pengaduan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tanggapan, $pengaduan)
    {
        $this->tanggapan = $tanggapan;
        $this->pengaduan = $pengaduan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.tanggapan');
    }
}
