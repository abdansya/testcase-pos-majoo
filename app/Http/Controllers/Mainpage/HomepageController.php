<?php

namespace App\Http\Controllers\Mainpage;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomepageController extends Controller
{
    protected $routeIndex = 'homepage';
    protected $viewFolder = 'mainpage.homepage';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['routeIndex'] = $this->routeIndex;
        $data['products'] = Product::all();
        return view($this->viewFolder . '.index', $data);
    }

}
