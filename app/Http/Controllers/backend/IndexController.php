<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\models\Order;

class IndexController extends Controller
{
    function getIndex() {
        $monthNow=Carbon::now()->format('m');
        $yearNow=Carbon::now()->format('Y');
        $data['month']=$monthNow;
        $data['order']=Order::where('state',1)->whereMonth('updated_at',$monthNow)->whereYear('updated_at',$yearNow);
        for($i=1;$i<=$monthNow;$i++){
            $data['total']['Tháng '.$i]=Order::where('state',1)->whereMonth('updated_at',$i)->whereYear('updated_at',$yearNow)->sum('total');
        }

        return view('backend.index',$data);
    }
}
