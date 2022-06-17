<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function sendEmail() { 
    	$details = ['title' => "Test mail",
    				'body' => 'Sample mail for test use'];

    	Mail::to("test@gmail.com")->send(new SendMail($details));
    	return "Email Sent!";

    }
}
