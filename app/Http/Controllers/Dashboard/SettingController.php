<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    
    public function social_login(){

        return view('dashboard.settings.social_login');

    }//end of social login

    public function social_links(){

        return view('dashboard.settings.social_links');

    }//end of social links

    public function store(Request $request){


        setting($request->all())->save();

        session()->flash('success' , 'Data Added Successfuly');

        return redirect()->back();


    }//end of store

}//end of controller 
