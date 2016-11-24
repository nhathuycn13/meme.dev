<?php

namespace App\Mail;

use App\Repository\Order\OrderRepo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;
use PDF;
class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;
    private $quote, $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quote, $content)
    {
        $this->quote = $quote;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = $this->content;
        $config = Config::get('company');

        $pdf = PDF::loadView('pdf.quote', ['quote' => $this->quote, 'config' => $config]);
        return $this->view('mail.quote', compact(['content']))->attachData($pdf->stream(), 'quote-' . $this->quote['data']->id . time() . '.pdf');
    }
}
