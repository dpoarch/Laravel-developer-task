<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Relations;
use App\Models\Subscribers;
use Illuminate\Support\Str;
use App\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscribersController extends Controller
{

    public function SendSubscriber(Request $request)
    {       
        $rules = array(
            "newsletter_id" => "required",
            "name" => "required|min:3|max:30",
            "email" => "required|email",
            "subject" => "required|min:5|max:100"
        );
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
                return $validator->errors();
        }

        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $image_64 = $request->attachment;

        if (preg_match("/^data:image\/(\w+);base64,/", $image_64)) {
            $extension = explode(
                "/",
                explode(":", substr($image_64, 0, strpos($image_64, ";")))[1]
            )[1];

            $replace = substr($image_64, 0, strpos($image_64, ",") + 1);
            $image = str_replace($replace, "", $image_64);

            $image = str_replace(" ", "+", $image);
            $imageName = Str::random(10) . "." . $extension;

            $attachment = base64_decode($image);
        } else {
            $imageName = Str::random(10) . ".pdf";
            $attachment = base64_decode($request->attachment);
        }

        $details = [
            "newsletter_id" => $request->newsletter_id,
            "email" => $request->email,
            "title" => "Stay In Touch",
            "subject" => $request->subject,
            "name" => $request->name,
            "body" => $request->message,
            "image" => $attachment,
            "imageName" => $imageName,
            "msg" => "unconfirmed"
        ];

        $sendmail = Mail::to($request->email)->send(
            new Mailer($subject, $details)
        );

        if (!empty($sendmail)) {
            return response()->json(["data" => ["message" => "ERR"]], 400);
        }

        
        $check = Subscribers::where("email", "=", $request->email)->get();

        $checkEmail = Subscribers::where("email", "=", $request->email);
        if ($checkEmail->get()->isEmpty()) {
            $subscribers = new Subscribers();
            $subscribers->name = $request->name;
            $subscribers->email = $request->email;
            $subscribers->save();

        } else {
            $verifyState = Subscribers::where("email", "=", $request->email)->where("state", "=", "unconfirmed")->get();

            if ($verifyState->isEmpty()) {
                return response()->json(
                    ["data" => ["message" => "Email already subscribed"]],
                    400
                );
            }
        }


        return response()->json(["data" => ["message" => "OK"]], 200);
    }
 
    public function showStatus(Request $request)
    {
        $data = Subscribers::where('id', $request->id)->first();

        return response()->json([$data], 200); 
    }



    public function Unsubscribe(Request $request)
    {


        $rules = array(
            "id" => "required",
            "newsletter_id" => "required",
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            
                return $validator->errors();

        }

         try{
            $verify_delete = Relations::where('subscriber_id','=', $request->id)->where('newsletter_id', '=', $request->newsletter_id)->delete();
            $verify_update = Subscribers::where('id', $request->id)->update(['state'=> 'unsubscribed']);

        }catch(\Illuminate\Database\QueryException $e){

            return response()->json(["data" => ['message' => $e]], 400); 

        }

        return response()->json(["data" => ['message' => "OK"]], 200); 
    }

    public function ConfirmSubscription(Request $request)
    {


        $rules = array(
            "newsletter_id" => "required",
            "email" => "required",
            "state" => "required",
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {

                return $validator->errors();

        }

        $subject = "Newsletter Reports";
        $email = $request->email;

             $details = [
                "newsletter_id" => $request->newsletter_id,
                "email" => $email,
                "title" => "Stay In Touch",
                "subject" => $subject,
                "name" => "",
                "body" => "",
                "image" => "",
                "imageName" => "",
                "msg" => "confirmed"
            ];

        $sendmail = Mail::to($email)->send(
                new Mailer($subject, $details)
            );

        if (!empty($sendmail)) {
            return response()->json(["data" => ["message" => "ERR"]], 400);
        }

        $data = Subscribers::where("email", "=", $request->email)->first();


        $relations = new Relations();
        $relations->subscriber_id = $data->id;
        $relations->newsletter_id = $request->newsletter_id;
        $relations->save();


        $subscribers = Subscribers::where('id', $data->id);
        
        $checkState = $subscribers->where('state', '=', $request->state)->get();

        if($checkState->isEmpty()){
            

            try{
                
                $verify_update = Subscribers::where('id', $data->id)->update(['state'=>$request->state]);

            }catch(\Illuminate\Database\QueryException $e){

                return response()->json(["data" => ['message' => $e]], 400); 

            }

        }else{

            return response()->json(["data" => ["message" => "Already Subscribed!"]], 400);

        }

        return response()->json(["data" => ['message' => "OK"]], 200); 
    }

 
}
