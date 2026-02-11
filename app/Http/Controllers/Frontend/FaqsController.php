<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    
    /*===========================================
    FAQS PAGE VIEW PAGE
    ===========================================*/

    public function ctrAboutUsView(){

        return view('frontend.pages.faq.faqs'); 

    } //End Method

}
