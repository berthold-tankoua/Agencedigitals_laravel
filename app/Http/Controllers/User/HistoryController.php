<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    //
    public function HistoryList(){
       $histories = History::latest()->delete();
        return $histories;
    }

    public function UserHistoryWeeklyDelete(){

        History::where('created_at', '<', Carbon::now()->subDays(7))->delete();
        Wishlist::where('created_at', '<', Carbon::now()->subDays(14))->delete();

        $response['status']=true;
        return $response;
    }
}
