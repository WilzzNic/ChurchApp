<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\GuestRequestKOM;

class KOMCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(GuestRequestKOM $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('wilson.nicholas56@gmail.com')
                    ->view('emails.kom.completed')
                    ->with([
                        'nama' => $this->request->guest->nama,
                        'seri_kom' => $this->request->jadwal->seri_kom,
                        'email' => $this->request->guest->email,
                        'cabang' => $this->request->jadwal->cabangGereja->nama_gereja,
                        'tanggal' => $this->request->tanggal,
                        'hari' => $this->request->jadwal->hari,
                        'waktu' => $this->request->jadwal->waktu,
                        'status' => $this->request->status
                    ]);
    }
}
