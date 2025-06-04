<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SavingsAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $savingsAccount;
    public $company;
    public function __construct($savingsAccount,$company)
    {
        $this->savingsAccount = $savingsAccount;
        $this->company = $company;
    }

    public function build()
    {
        return $this->subject('BRCFinance - Your Savings Account has been Created')
                    ->view('emails.savings_account_created')
                    ->with([
                        'company' => $this->company,
                        'savingsAccount' => $this->savingsAccount,
                    ]);
    }
}
