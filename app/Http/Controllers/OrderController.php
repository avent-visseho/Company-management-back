<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Provider;
use App\Models\Product;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function indexOrder()
    {
    $orders = Order::all();

    return view('editOrder')->with('orders', $orders);
    }
   
    public function storeOrder( Request $request){
        $data=$request->all();
        $validation =$request->validate([
            "quantity" => "required",
            "product_id" => "required",
            "provider_id" => "required",
            "orderDate" => "required",
            "observation" => "required",
            "status" => "required",
           ]);
            Marque::updateOrCreate([
                'product_id'=>$data['product_id'],
                'quantity'=>$data['quantity'],
                'provider_id'=>$data['provider_id'],
                'orderDate'=>$data['orderDate'],
                'observation'=>$data['observation'],
                'status'=>$data['status'],
            ]);
        
        return redirect()->route('order');
    }
    public function editOrder($id){
        $product=Product::all();
        $provider=Provider::all();
        $order=Order::find($id);
        return view('editOrder', compact('order', 'products', 'providers'));
    }

    public function updateOrder(Request $request,$id) {
        $data=Order::where('id',$id)->first();
        $request->validate([
            "new_quantity" => "required",
            "new_product" => "required",
            "new_provider" => "required",
            "new_orderDate" => "required",
            "new_observation" => "required",
            "new_status" => "required",
        ]);
        $data->update([
            'quantity' => $request->input('new_quantity'),
            'product_id' => $request->input('new_product')['product_id'],
            'provider_id' => $request->input('new_provider')['provider_id'],
            'orderDate' => $request->input('new_orderDate'),
            'observation' => $request->input('new_observation'),
            'status' => $request->input('new_status'),
        ]);
        return redirect()->route('order');
    }  
    public function deleteOrder($id)
    {
        Marque::where('id',$id)->delete();
        return redirect()->route('order');
    }

}
