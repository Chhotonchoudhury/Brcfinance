<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SavingsTransaction extends Mailable
{
    use Queueable, SerializesModels;

    protected $company;
    protected $savingsAccount;
    protected $transaction;

    public function __construct($company, $savingsAccount, $transaction)
    {
        $this->company = $company;
        $this->savingsAccount = $savingsAccount;
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->subject('BRCFinance - Your Account transaction done successfully')
                    ->view('emails.savings_transaction')
                    ->with([
                        'company' => $this->company,
                        'savingsAccount' => $this->savingsAccount,
                        'transaction' => $this->transaction,
                    ]);
    }
}
