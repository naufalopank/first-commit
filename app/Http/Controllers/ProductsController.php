<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Product; 
 
class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function add()
    {
        return view('create');
    }
 
    public function cart()
    {
        return view('cart');
    }
    public function create(Request $request)
    {
        $validated = 
        $request->validate([
            'img'=> 'required |img',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ], [
            'img.required'=> 'Foto Produk Tidak Boleh Kosong',
            'name.required'=> 'Nama Produk Tidak Boleh Kosong',
            'description.required'=> 'Deskripsi Produk Tidak Boleh Kosong',
            'price.required'=> 'Nama Produk Tidak Boleh Kosong',
            'category_id.required'=> 'Kategori_Id Tidak Boleh Kosong'
        ]);
        //===============
        $data['img'] = $request->file('img')->store('img','public');
        $data =$request->all();
        //===============
        Product::create($data);
        //===============
        return redirect()->route('index');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
 
        $cart = session()->get('cart', []);
 
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "photo" => $product->photo,
                "price" => $product->price,
                "quantity" => 1
            ];
        }
 
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }
   
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}