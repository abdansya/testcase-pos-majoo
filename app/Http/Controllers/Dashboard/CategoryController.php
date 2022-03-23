<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $routeIndex = 'categories';
    protected $viewFolder = 'dashboard.categories';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['routeIndex'] = $this->routeIndex;
        $list = Category::query();
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
                    'name' => 'required|string|min:1|max:1000|unique:categories',
                ],
                [
                    'name.required' => 'Mohon lengkapi nama kategori.',
                    'name.unique' => 'Nama kategori yang anda masukkan sudah ada, silakan isikan yang lain.'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = [
                'name' => $request->name
            ];
            $saveData = Category::create($data);
            
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['detail'] = $category;
        return view($this->viewFolder . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['detail'] = $category;
        return view($this->viewFolder . '.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator::make($request->all(),
                [
                    'name' => 'required|string|min:1|max:1000|unique:categories,name,'.$category->id,
                ],
                [
                    'name.required' => 'Mohon lengkapi nama kategori.',
                    'name.unique' => 'Nama kategori yang anda masukkan sudah ada, silakan isikan yang lain.'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $detail = $category;
            $data = [
                'name' => $request->name
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
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->delete()) {
            Alert::success('Success', 'Data telah terhapus!');
        } else {
            Alert::error('Error', 'Maaf terjadi kesalahan saat menghapus data, silakan coba lagi!');
        }
        return redirect()->back();
    }
}
