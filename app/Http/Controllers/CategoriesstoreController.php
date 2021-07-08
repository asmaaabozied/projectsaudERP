<?php


namespace App\Http\Controllers;

use App\Account;
use App\Baku;
use App\Box;
use App\Carton;
use App\Cat_cart;
use App\Catcart_attribute;
use App\Classification;
use App\MainAccount;
use App\Marpurchase;
use App\Marpurchase_attribute;
use App\Products;
use App\Purchase;
use App\PurchaseProduct;
use App\Store;
use App\Suppliers;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class CategoriesstoreController extends Controller
{

    public function destroy($id)
    {

        $slider = Marpurchase::find($id);

        $slider->delete();
        $baku = Marpurchase_attribute::where('marpurchase_id', $id)->first();
        if ($baku) {
            $baku->delete();
        }

        flash('deleted_successfully')->success();
      return back();
    }

    public function create()
    {

        $user=User::find(Auth::id());

        $classifications = Classification::get();

        $stores = Store::get();
        $suppliers = Suppliers::get();
        $products = Cat_cart::get();
        return view('admin.marpurchases.createReturn', compact('stores', 'classifications', 'suppliers', 'products'));
    }


    public function index()
    {
        $stores = Store::get();
        $suppliers = Suppliers::get();
        $drivers = Marpurchase::where('type','Categories')->where('company_id',Auth::user()->company_id)->get();
        return view('admin.marpurchases.index2', compact('drivers', 'suppliers', 'stores'));
    }





    public function show($id)
    {
        $user=User::find(Auth::id());

        $driver = Marpurchase::find($id);
        $classifications = Classification::get();
        $stores = Store::get();
        $suppliers = Suppliers::get();
//        $products=Products::all();

        $products = Marpurchase_attribute::where('marpurchase_id', $id)->get();
        return view('admin.marpurchases.show', compact('driver', 'suppliers', 'stores', 'classifications', 'products'));
    }




    public function store(Request $request)
    {

        $cart = Marpurchase::create($request->except('_token', 'name', 'number', 'value', 'quantity', 'size', 'tax','discount','unit')+['type'=>'Categories','company_id'=>Auth::user()->company_id]);
        foreach ($request->name as $key => $value) {
            Marpurchase_attribute::create([

                'name' => $request['name'][$key],
                'unity' => $request['unit'][$key],
                'value' => $request['value'][$key],
                'number' => $request['number'][$key],

//                'size' => $request['size'][$key],

                'tax' => $request['tax'][$key],
                'discount'=> $request['discount'][$key],

                'qty' => $request['quantity'][$key],
                'marpurchase_id' => $cart->id


            ]);

        }
        flash('added_successfully')->success();
        return back();



    }



    public function edit($id)
    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $driver = Products::find($id);
        $baku = Baku::where('product_id', $id)->first();
        $box = Box::where('product_id', $id)->first();
        $carton = Carton::where('product_id', $id)->first();
        $user = User::find($_SESSION['admin_id']);

        $classifications = Classification::where('company_id', $user->company_id)->get();
        $stores = Store::where('company_id', $user->company_id)->get();
        $suppliers = Suppliers::where('company_id', $user->company_id)->get();
        return view('admin.products.edit', compact('driver', 'baku', 'box', 'carton', 'stores', 'suppliers', 'classifications'));

    }

    public function update(Request $request, $id)

    {
//        if (!isset($_SESSION['admin_id'])) {
//            return redirect('/admin/login');
//        }
        $admin = Products::find($id);
        $admin->name = $request->name;
        $admin->supplier_id = $request->supplier_id;
        $admin->store_id = $request->store_id;
        $admin->classificaiton_id = $request->classificaiton_id;
        $admin->min_price = $request->min_price;
        $admin->max_price = $request->max_price;
        $admin->price_system = $request->price_system;
        $admin->save();
        $baku = Baku::where('product_id', $id)->first();
        $baku->type = $request->type;
        $baku->price = $request->price;
        $baku->order = $request->order;
        $baku->bacode1 = $request->bacode1;
        $baku->bacode2 = $request->bacode2;
        $baku->current_price = $request->current_price;
        $baku->dicount = $request->dicount;
        $baku->unit = $request->unit;
        $box = Box::where('product_id', $id)->first();
        $box->type_2 = $request->type_2;
        $box->price_2 = $request->price_2;
        $box->order_2 = $request->order_2;
        $box->bacode1_2 = $request->bacode1_2;
        $box->bacode2_2 = $request->bacode2_2;
        $box->current_price_2 = $request->current_price_2;
        $box->dicount_2 = $request->dicount_2;
        $box->unit_2 = $request->unit_2;
        $box->save();
        $carton = Carton::where('product_id', $id)->first();
        $carton->type_3 = $request->type_3;
        $carton->price_3 = $request->price_3;
        $carton->order_3 = $request->order_3;
        $carton->bacode1_3 = $request->bacode1_3;
        $carton->bacode2_3 = $request->bacode2_3;
        $carton->current_price_3 = $request->current_price_3;
        $carton->dicount_3 = $request->dicount_3;
        $carton->unit_3 = $request->unit_3;
        $carton->save();
        return redirect()
            ->route("products.index")
            ->with("success", "products updated successfully");


    }

    public function deletepurchase($id)
    {
        $purchase = Purchase::find($id);
        $trans = Transaction::where('registration_number', $purchase->registration_number)->get();
        if (count($trans) > 0) {
            foreach ($trans as $tran) {
                $tran->delete();
            }
        }
        $purchase->delete();

        return back()
            ->with("success", "تم حذف القيد بنجاح");
    }

}
