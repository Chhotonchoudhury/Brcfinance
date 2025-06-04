<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $company;

    public function __construct($member, $company)
    {
        $this->member = $member;
        $this->company = $company;
    }

    public function build()
    {
        return $this->subject('Welcome to BRCFinance - Your Membership is Created Successfully')
            ->view('emails.member_welcome')
            ->with([
                'member' => $this->member,
                'company' => $this->company,
            ]);
    }
}