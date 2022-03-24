<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    protected $routeIndex = 'products';
    protected $viewFolder = 'dashboard.products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['routeIndex'] = $this->routeIndex;
        $list = Product::query();
        $data['list'] = $list->paginate(10);
        return view($this->viewFolder . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['categories'] = Category::all();
        return view($this->viewFolder . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), 
                [
                    'name' => 'required|string|min:1|max:1000|unique:products',
                    'description' => 'required|string|min:10|max:10000',
                    'price' => 'required|integer|min:1000|max:2000000000',
                    'image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ],
                [
                    'name.required' => 'Mohon lengkapi nama produk.',
                    'name.unique' => 'Nama produk yang anda masukkan sudah ada, silakan isikan yang lain.',
                    'description.required' => 'Mohon lengkapi deskripsi produk.',
                    'description.min' => 'Minimal deskripsi produk adalah 5 karakter',
                    'description.max' => 'Maksimal deskripsi produk adalah 10.000 karakter',
                    'price.required' => 'Mohon lengkapi harga produk.',
                    'price.integer' => 'Harga produk harus berupa angka.',
                    'price.min' => 'Minimal harga produk adalah Rp.1000',
                    'price.max' => 'Maksimal harga produk adalah 2 miliar rupiah',
                    'image.required' => 'Mohon lengkapi foto produk.',
                    'category_id.required' => 'Mohon lengkapi kategori produk.',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => url($request->image),
                'category_id' => $request->category_id,
            ];
            $saveData = Product::create($data);
            
            if(!$saveData->exists) {
                Alert::error('Error', 'Terjadi kesalahan saat menyimpan data, silahkan coba lagi!');
            }
            
            Alert::success('Sukses', 'Data telah tersimpan!');
            return redirect(route($this->routeIndex));
        } catch (\Exception $exception) {
            Alert::error('Error', 'Mohon maaf ada keaslahan sistem, silakan coba beberapa saat lagi.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['detail'] = $product;
        return view($this->viewFolder . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['detail'] = $product;
        $data['categories'] = Category::all();
        return view($this->viewFolder . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validator = Validator::make($request->all(), 
                [
                    'name' => 'required|string|min:1|max:1000|unique:products,name,'.$product->id,
                    'description' => 'required|string|min:10|max:10000',
                    'price' => 'required|integer|min:1000|max:2000000000',
                    'image' => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ],
                [
                    'name.required' => 'Mohon lengkapi nama produk.',
                    'name.unique' => 'Nama produk yang anda masukkan sudah ada, silakan isikan yang lain.',
                    'description.required' => 'Mohon lengkapi deskripsi produk.',
                    'description.min' => 'Minimal deskripsi produk adalah 5 karakter',
                    'description.max' => 'Maksimal deskripsi produk adalah 10.000 karakter',
                    'price.required' => 'Mohon lengkapi harga produk.',
                    'price.integer' => 'Harga produk harus berupa angka.',
                    'price.min' => 'Minimal harga produk adalah Rp.1000',
                    'price.max' => 'Maksimal harga produk adalah 2 miliar rupiah',
                    'category_id.required' => 'Mohon lengkapi kategori produk.',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $detail = $product;
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => url($request->image),
                'category_id' => $request->category_id,
            ];
            if(!$detail->update($data)) {
                Alert::error('Error', 'Terjadi kesalahan saat menyimpan data, silahkan coba lagi!');
            }
            
            Alert::success('Sukses', 'Data telah tersimpan!');
            return redirect(route($this->routeIndex));
        } catch (\Exception $exception) {
            Alert::error('Error', 'Mohon maaf ada keaslahan sistem, silakan coba beberapa saat lagi.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()) {
            Alert::success('Success', 'Data telah terhapus!');
        } else {
            Alert::error('Error', 'Maaf terjadi kesalahan saat menghapus data, silakan coba lagi!');
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), 
                [
                    'image' => 'required|image|max:1024',
                ],
                [
                    'image.required' => 'Mohon lengkapi foto produk.',
                    'image.image' => 'Foto produk harus berupa gambar.',
                    'image.max' => 'Ukuran foto produk maksimal 1 Mb.',
                ]
            );
            if ($validator->fails()) {
                return sendApiResponse(false, $validator->errors()->first(), $validator->errors(), 422);
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $name = str_replace('.'.$extension, '', $file->getClientOriginalName());
            $path = $request->file('image')->storeAs(
                'images', $name . time() .'.'.$extension, 'public'
            );
            $path = Storage::url($path);
            
            return sendApiResponse(true, 'Upload berhasil!', ['path' => $path, 'name' => $name]);
        } catch (\Exception $exception) {
            return sendApiResponse(false, $exception->getMessage(), null, 400);
        }
    }
}
