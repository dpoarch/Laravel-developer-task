<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {  
        $list = Newsletter::all()->sortBy("id");

        return response()->json($list, 200);
    }

    public function show(Request $request)
    {  
        $currentNewsletter = Newsletter::where('id', $request->id)->first();

        return response()->json($currentNewsletter, 200);
    }
}
