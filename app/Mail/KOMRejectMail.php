<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\GuestRequestKOM;

class KOMRejectMail extends Mailable
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
                    ->view('emails.kom.reject')
                    ->with([
                        'seri_kom' => $this->request->jadwal->seri_kom,
                    ]);
    }
}
