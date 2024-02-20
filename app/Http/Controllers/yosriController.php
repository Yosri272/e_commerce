<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class yosriController extends Controller
{
   public function index()
    {

        return view('layout');
      
    } 
          public function welcome()
       {

       return view('welcome');
        
    } 
      public function checkout(Request $request)
    {
       // dd($id);
       
       return view('checkout');
       
    }
     public function invoice()
    {

        return view('invoice-view');
    }
     public function successful()
    {

        return view('invoice-view-s');
    }
    
    ///////////pp
    
    
     // save customer`s order in merchant database

    public function store(Request $request)

    {

        //
      //  dd($request);

       

        

        $order->save();
        return redirect()->route('OTPSMS');

    }


}
