<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RdAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $rdAccount;
    public $company;
    public function __construct($rdAccount,$company)
    {
        $this->savingsAccount = $rdAccount;
        $this->company = $company;
    }

    public function build()
    {
        return $this->subject('BRCFinance - Your RD Account has been Created')
                    ->view('emails.rd_account_created')
                    ->with([
                        'company' => $this->company,
                        'savingsAccount' => $this->savingsAccount,
                    ]);
    }
}
