<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_Customer;
use App\OrderItem;
use Carbon\Carbon;
use Psy\Util\Json;
use App\Promotion;
use DB;
use Session;


class OrderController extends Controller
{
    public function getAll()
    {
        $all = Order::orderBy('date_order', 'DESC')->get();
        return view('admin.order.List')->with(['orders' => $all]);
    }


    public function api_insertOder(Request $request)
    {
        $cart = json_decode($request->cart, true);
        if (isset($request->promotion_code)) {
            $code = $request->promotion_code;
            $promotion = Promotion::where('code', $code)->first();
            if ($promotion['quantity'] > 0) {
                $promotion->quantity = $promotion->quantity - 1;
                $promotion->save();
            }
        }
        $order = new Order;
        $order->customer_id = $request->customer_id;
        $order->status = 'Chưa giao hàng';
        $order->customer_name = $request->customer_name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->summary = $request->summary;
        $order->date_order = Carbon::now();
        if (isset($request->promotion_code)) {
            $order->promotion_code = $request->promotion_code;
        } else {
            $order->promotion_code = 'Không có mã giảm giá';
        }
        $order->save();
        foreach ($cart as $index => $cartItem) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cartItem["product"]["id"];
            $orderItem->quantity = $cartItem["quantity"];
            $orderItem->shop_id = $cartItem["product"]["shop_id"];
            $orderItem->status = "Chưa giao hàng";
            $orderItem->save();
        }
        return response()->json(['success' => 1, 'data' => 'Đã thanh toán thành công, bạn có thể xem lại đơn hàng trong mục đơn hàng của bạn']);
    }





    public function api_findOrderOfCustomer($idCustomer)
    {
        $result = Order::where('customer_id', $idCustomer)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['kq' => 1, 'data' => $result]);
    }

    public function api_deleteOrderItem($id)
    {
        $order = OrderItem::where('id', $id)->first();
        $order->status = 'Đơn hàng đã huỷ';
        $order->save();
        return response()->json(['data' => 'Đơn hàng đã huỷ']);
    }

    public function findOrderByCustomer($idCustomer)
    {
        $order = Order::where('customer_id', $idCustomer)->orderBy('date_order', 'DESC')->get();
        return response()->json(['success' => 1, 'data' => $order]);
    }

    public function findOrderItem($idOrder)
    {
        $orderItems = DB::table('order_item')
            ->join('product', 'product.id', '=', 'order_item.product_id')
            ->join('shop', 'product.shop_id', '=', 'shop.id')
            ->where('order_id', '=', "$idOrder")
            ->get(['product.name as product_name', 'product.description', 'product.price', 'order_item.quantity', 'shop.name as shop_name', 'product.id as product_id', 'status', 'order_item.id as id']);
        return response()->json(['success' => 1, 'data' => $orderItems]);
    }

    public function deleteOrder($id)
    {
        $order = Order::where('id', $id)->first();
        $order->status = "Đơn hàng đã huỷ";
        $order->save();

        $findItem = OrderItem::where('order_id', $id)->get();
        foreach ($findItem as $obj) {
            $item = OrderItem::where('id', $obj["id"])->first();
            $item->status = "Đơn hàng đã huỷ";
            $item->save();
        }
        return response()->json(['success' => 1, 'data' => 'Đã huỷ thành công đơn hàng']);
    }


    public function deleteOrder_admin($id)
    { //dùng cho trang admin
        $order = Order::where('id', $id)->first();
        $order->status = "Đơn hàng đã huỷ";
        $order->save();

        $findItem = OrderItem::where('order_id', $id)->get();
        foreach ($findItem as $obj) {
            $item = OrderItem::where('id', $obj["id"])->first();
            $item->status = "Đơn hàng đã huỷ";
            $item->save();
        }
        Session::flash('success', 'Đã huỷ đơn hàng có id = ' . $order->id);
        return redirect()->back();
    }


    public function findAllProductAreOrdered($idShop)
    {
        $product = DB::table('product')
            ->join('order_item', 'product.id', '=', 'order_item.product_id')
            ->join('order_customer', 'order_item.order_id', '=', 'order_customer.id')
            ->where('order_item.shop_id', '=', "$idShop")
            ->get(['order_item.id as id', 'product.name as product_name', 'order_item.quantity as quantity', 'order_item.status', 'order_customer.address', 'order_customer.phone', 'order_customer.customer_name']);
        return response()->json(['success' => 1, 'data' => $product]);
    }

    public function productOrder($id)
    {
        $products = DB::table('order_item')
            ->join('product', 'product.id', '=', 'order_item.product_id')
            ->join('shop', 'product.shop_id', '=', 'shop.id')
            ->where('order_id', '=', "$idOrder")
            ->get(['product.name as product_name', 'product.description', 'product.price', 'order_item.quantity', 'shop.name as shop_name', 'product.id as product_id']);
        return response()->json(['success' => 1, 'data' => $products]);
        return view('admin.order.productList') - with(['products' => $products]);
    }


    public function orderItem($id)
    {
        $orderItems = DB::table('order_item')
        ->join('product', 'product.id', '=', 'order_item.product_id')
        ->join('shop', 'product.shop_id', '=', 'shop.id')
        ->where('order_id', '=', "$id")
        ->get(['product.name as product_name', 'product.description', 'product.price', 'order_item.quantity', 'shop.name as shop_name', 'product.id as product_id', 'status', 'order_item.id as id']);
        return view('admin.order.ListItem')->with(['orderItems'=>$orderItems]);
    }

    public function UpdateOrderItem($id){
        $orderItem = DB::table('order_item')->where('id', $id)->first();
        return view('admin.order.UpdateOrder')->with(['orderItem'=>$orderItem]);
    }



    public function api_updateOrder($id)
    {
        $order = DB::table('order_item')->where('id', $id)->get();
        return response()->json(['success' => 1, 'data' => $order]);
    }

    public function api_updateOrderItem($id, Request $request)
    {
        $orderItem = OrderItem::where('id', $id)->first();
        $orderItem->status = $request->status;
        $orderItem->save();
        return response()->json(['success' => 1, 'data' => 'Đã update order ']);
    }

    public function postUpdateOrder($id, Request $request)
    {
        $order = OrderItem::where('id', $id)->first();
        $order->status = $request->status;
        $order->save();
        Session::flash('success', 'Đã update thành công');
        return redirect()->back();
    }
}
