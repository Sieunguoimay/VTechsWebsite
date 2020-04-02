<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class OrdersController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth',['except'=>
            ['getCapacityForm','queryByCapacity','saveBookingInfo']]);
        $this->viewsController = new ViewsController();
    }

    private function buildHtml($capacity,$quality){
        
        $capacityVariants = array(
            ['capacity'=>'3kW', 'amount'=>9],
            ['capacity'=>'5kW', 'amount'=>14],
            ['capacity'=>'10kW', 'amount'=>28],
            ['capacity'=>'15kW', 'amount'=>40]
        );

        $qualityVariants = array(
            ['brand'=>'Vsun',       'power'=>'370W', 'inverter'=>'Growatt'],
            ['brand'=>'Canadian',   'power'=>'395W', 'inverter'=>'Growatt'],
            ['brand'=>'Qcell',      'power'=>'395W', 'inverter'=>'SMA']
        );
        $otherVariants = array(
            ['payback_period'=>6,   'cost'=>"6.238.383",'productivity'=>3256],
            ['payback_period'=>6.5, 'cost'=>"6.797.000",'productivity'=>3548],
            ['payback_period'=>6.5, 'cost'=>"6.865.000",'productivity'=>3583],

            ['payback_period'=>5,   'cost'=>"9.804.000",'productivity'=>5117],
            ['payback_period'=>6.5, 'cost'=>"10.572.000",'productivity'=>5518],
            ['payback_period'=>6,   'cost'=>"10.680.000",'productivity'=>3574],

            ['payback_period'=>5,   'cost'=>"19.608.000",'productivity'=>10234],
            ['payback_period'=>6.5, 'cost'=>"21.469.000",'productivity'=>11037],
            ['payback_period'=>6,   'cost'=>"21.360.000",'productivity'=>11148],

            ['payback_period'=>5,   'cost'=>"28.012.000",'productivity'=>14620],
            ['payback_period'=>6.5, 'cost'=>"30.209.000",'productivity'=>15767],
            ['payback_period'=>6,   'cost'=>"30.514.000",'productivity'=>15926]
        );
        $capacityVariant = $capacityVariants[$capacity];
        $qualityVariant = $qualityVariants[$quality];
        $otherVariant = $otherVariants[$capacity*3+$quality];
        
        $html = strval(view("inc.capacity.technical_info")
                ->with('data',
                (object)array_merge(
                    array_merge((array)$capacityVariant,(array)$qualityVariant)
                    ,(array)$otherVariant)));
        return $html;
    }
    public function getCapacityForm(){
        return view('inc.capacity.capacity_form');
    }
    public function queryByCapacity(Request $request){

        $response = array("status"=>"OK");
        try{
            // $capacityVariant = $capacityVariants[$request->capacity];
            // $qualityVariant = $qualityVariants[$request->quality];
            // $otherVariant = $otherVariants[$request->capacity*3+$request->quality];
            $response["html"] = $this->buildHtml($request->capacity,$request->quality);
        }catch(\Exception $e){
            $response["status"] = $e->getMessage();
        }
        return response()->json($response);        
    }
    public function saveBookingInfo(Request $request){
        $response = array("status"=>"OK");
        try{
            $order = new Order();
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->message = $request->message;
            $order->other_data=json_encode($request->other_data);
            $order->save();
            $response["message"] = $request->email.$request->phone;
        }catch(\Exception $e){
            $response["status"] = $e->getMessage();
        }
        return response()->json($response);
    }
    public function show(){
        $user = auth()->user();//User::find($user_id);
        if($user->is_admin){
            $orders = Order::all();
            $html = "";
            $index = 0;
            foreach($orders as $order){
                $index++;
                $data = json_decode($order->other_data);
                if($data){
                    $html .= "<h4>$index. </h4>";
                    $html .= "<p><label>Email:</label> ".$order->email."</p>";
                    $html .= "<p><label>Phone:</label> ".$order->phone."</p>";
                    $html .= "<p><label>Message:</label> ".$order->message."</p>";
                    $html .= $this->buildHtml($data->capacity,$data->quality);
                    $html .="<br><br>";
                }
            }
            return view('orders.index')->with('content',$html);
        }
        return "BLEH";
    }
}
