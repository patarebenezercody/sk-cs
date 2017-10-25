<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Sktm;
use Alert;
class SktmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $data=
        [  
            'name' => $request['name'],
            'nokk' => $request['nokk'], 
            'nohp' => $request['nohp'] 
        ];
        return Sktm::create($data);
    }

   
}
