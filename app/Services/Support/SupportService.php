<?php

namespace App\Services\Support;

use App\Mail\SupportReceiptMail;
use Illuminate\Support\Facades\Mail;


class SupportService
{

    public function sendSupportEmail(array $reqeust): void
    {
        $email = $reqeust['email'];
        $name = $reqeust['name'];
        $reason = $reqeust['reason'];
        $message = $reqeust['message'];

        Mail::to($email)->send(new SupportReceiptMail($name, $reason, $message));

    }

}