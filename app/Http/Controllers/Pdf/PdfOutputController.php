<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cart;
use App\Models\Shop;
use Carbon\Carbon;

class PdfOutputController extends Controller
{
//営業ユーザの売上報告
    public function output_pdf()
    {
        $shop = Shop::where('user_id',auth()->id())->first();
        $carts = Cart::where('shop_id',$shop->id)
                    ->select('cake_id','size','price', Cart::raw('count(*) as total'))
                    ->groupBy('cake_id','size','price')->with('cake')->get();

        $total =0;
        foreach($carts as $cart){
            $subtotal = Cart::where('size',$cart->size)->where('cake_id',$cart->cake_id)->sum('subtotal');
            $total = $total+$subtotal;
        }
        $tax = $total * 0.08;
        $total = $tax + $total;

        $proceed = new Cart;
        $show_shop = Shop::where('user_id',auth()->id())->first();
        $dt = new Carbon();
        $date = $dt->toDateString();
        
        $pdf = Pdf::loadView('pdf.product-proceeds',compact('carts','proceed','tax','total','show_shop','date'));
        $pdf->setPaper('A4');

        return $pdf->stream('売上報告.pdf');

    } 
}   
