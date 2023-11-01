<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');

        $producs = Product::all();
        return view('products.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'category_id' => 'required',
        'nama' => 'required|string',
        'qty' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'spek' => 'nullable',
        'barcode' => 'required',
        'date' => 'required',
        'posisi' => 'required',
    ]);

    $input = $request->all();
    $input['image'] = null;

    if ($request->hasFile('image')) {
        $input['image'] = '/upload/products/' . str_slug($input['nama'], '-') . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('/upload/products/'), $input['image']);
    }

    Product::create($input);

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil dibuat'
    ]);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('name','ASC')
            ->get()
            ->pluck('name','id');
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'category_id' => 'required',
        'nama' => 'required|string',
        'qty' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'spek' => 'nullable',
        'barcode' => 'required',
        'date' => 'required',
        'posisi' => 'required',
    ]);

    $input = $request->all();
    $product = Product::findOrFail($id);

    $input['image'] = $product->image;

    if ($request->hasFile('image')) {
        if (!$product->image == NULL) {
            unlink(public_path($product->image));
        }
        $input['image'] = '/upload/products/' . str_slug($input['nama'], '-') . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('/upload/products/'), $input['image']);
    }

    $product->update($input);

    return response()->json([
        'success' => true,
        'message' => 'Produk berhasil diperbarui'
    ]);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->image == NULL){
            unlink(public_path($product->image));
        }

        Product::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Products Deleted'
        ]);
    }

    public function apiProducts(){
        $products = Product::all();
    
        return Datatables::of($products)
            ->addColumn('id', function ($product){
                return $product->id;
            })
            ->addColumn('category_id', function ($product){
                return $product->category->name;
            })
            ->addColumn('nama', function($product) {
                return $product->nama;
            })
            ->addColumn('spec', function($product) {
                return $product->spec;
            })
            ->addColumn('qty', function($product) {
                return $product->qty;
            })
            ->addColumn('barcode', function($product) {
                return $product->barcode;
            })
            ->addColumn('date', function($product) {
                // Format kolom tanggal sesuai kebutuhan Anda
                return $product->date;
            })
            ->addColumn('posisi', function($product) {
                return $product->posisi;
            })
            ->addColumn('action', function($product){
                return '<a onclick="editForm('. $product->id .')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-edit"></i> Edit</a> ' .
                    '<a onclick="deleteData('. $product->id .')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->rawColumns(['category_name','action'])
            ->make(true);
    }
    
}
