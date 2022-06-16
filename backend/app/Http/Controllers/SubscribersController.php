<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */
    public function showStatus(Request $request)
    {
        $data = Subscribers::where('id', $request->id)->first();

        return response()->json([$data], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscribers  $subscribers
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
    
      Subscribers::where('id',$request->id)->update(['state'=>$request->state]);

      return response()->json(['message' => 'success'], 200); 
    }

    public function destroy(Subscribers $subscribers)
    {
        //
    }
}
