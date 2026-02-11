<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //

   public function LanguageLoad(Request $request){

	$response['status']=true;
	return $response;

   }


}