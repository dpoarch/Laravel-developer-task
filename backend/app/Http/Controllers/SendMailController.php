<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Support\Str;
use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //
    public function SendMailer(Request $request){
    	$data = Subscribers::where('email', '=', $request->email)->first();

    	$subject = $request->subject; 

    	$image_64 =  $request->attachment;


    	if (preg_match('/^data:image\/(\w+);base64,/', $image_64)) {
		 $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

		 $replace = substr($image_64, 0, strpos($image_64, ',')+1); 
		 $image = str_replace($replace, '', $image_64); 

		 $image = str_replace(' ', '+', $image);
		 $imageName = Str::random(10).'.'.$extension;

		 $attachment = base64_decode($image);
		}else{
			$imageName = Str::random(10).'.pdf';
			$attachment = base64_decode($request->attachment);
		}

    	$details = ['data'=> $data, 'title'=> 'Stay In Touch', 'subject' => $request->subject, 'name' => $request->name, 'body' => $request->message, 'image' => $attachment, 'imageName' => $imageName];
    	$check = Subscribers::where('email', '=', $request->email)->get();

	
		

		$checkEmail = Subscribers::where('email', '=', $request->email);
		if($checkEmail->get()->isEmpty()){
			
			$subscribers = new Subscribers;
	        $subscribers->name = $request->name;
	        $subscribers->email = $request->email;
	        $subscribers->state = 'unconfirmed';
	        $subscribers->save();

		}else{

			$verifyState = $checkEmail->where('state', '=', 'unconfirmed')->get();
			if($verifyState->isEmpty()){
				return response()->json(['message' => 'Email already subscribed'], 400); 
			}
		}

		$sendmail = Mail::to($request->email)->send(new Mailer($subject, $details)); 

	    	if (!empty($sendmail)) { 
	    		return response()->json(['message' => 'error'], 400); 
	    	}

		return response()->json(['message' => 'success'], 200); 
	    
	    
		
    }

    public function ConfirmSubscription(Request $request){
      Subscribers::where('id',$request->id)->update(['state'=>$request->state]);

	  return response()->json(['message' => 'success'], 200); 
		
	}
}
