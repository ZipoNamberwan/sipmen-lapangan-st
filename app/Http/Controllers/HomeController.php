<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = 0;
        $subdistricts = Auth::user()->subdistricts;
        $receivingData = [];
        foreach ($subdistricts as $s) {
            foreach ($s->villages as $v) {
                $total = $total + count($v->sls);
                $data = [];
                $data['subdistrict'] = $s->name;
                $data['village'] = $v->name;
                $data['total'] = count($v->sls);
                $receivingPerVillage = 0;
                foreach ($v->sls as $sls) {
                    if (count($sls->receivings) > 0)
                        $receivingPerVillage++;
                }
                $data['receiving_total'] = $receivingPerVillage;

                $receivingData[] = $data;
            }
        }
        $receiving = count(Receiving::where(['user_id' => Auth::user()->id])->get());


        return view('dashboard', ['total' => $total, 'receiving' => $receiving, 'receivingData' => $receivingData]);
    }
}
