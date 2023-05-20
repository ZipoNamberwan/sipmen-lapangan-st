<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use App\Models\Sls;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReceivingControlller extends Controller
{
    public function indexReceiving()
    {

        return view('index-receiving');
    }
    public function createReceiving()
    {
        $subdistricts = Auth::user()->subdistricts;

        return view('add-receiving', ['subdistricts' => $subdistricts]);
    }
    public function getVillage($id)
    {
        return json_encode(Village::where('subdistrict_id', $id)->get());
    }
    public function getSls($id)
    {
        return json_encode(Sls::where('village_id', $id)->get());
    }
    public function storeReceiving(Request $request)
    {
        $this->validate($request, [
            'subdistrict' => 'required',
            'village' => 'required',
            'sls' => 'required',
            'date' => 'required',
            'l2' => 'required',
            'sender' => 'required',
        ]);

        Receiving::create([
            'map' => $request->has('map'),
            'l1' => $request->has('l1'),
            'l2' => $request->l2,
            'date' => $request->date,
            'sender' => $request->sender,
            'note' => $request->note,
            'sls_id' => $request->sls,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/receiving-success');
    }

    public function successReceiving()
    {
        return view('success-add-receiving');
    }
    public function getDataReceiving(Request $request)
    {
        $recordsTotal = Receiving::where(['user_id' => Auth::user()->id])->count();

        $orderColumn = 'fate';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '2') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '3') {
                $orderColumn = 'sls_id';
            } else if ($request->order[0]['column'] == '4') {
                $orderColumn = 'sls_id';
            }
        }
        $searchkeyword = $request->search['value'];
        $sls = Receiving::where(['user_id' => Auth::user()->id])->get();
        if ($searchkeyword != null) {
            $sls = $sls->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->sls->subdistrict->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->sls->village->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->sls->name), strtolower($searchkeyword)) ||
                    Str::contains($q->sls->log_code, $searchkeyword) ||
                    Str::contains(strtolower($q->sender), strtolower($searchkeyword));
            });
        }
        $recordsFiltered = $sls->count();

        if ($orderDir == 'asc') {
            $sls = $sls->sortBy($orderColumn);
        } else {
            $sls = $sls->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $sls = $sls->skip($request->start)
                ->take($request->length);
        }

        $slsArray = array();
        $i = $request->start + 1;
        foreach ($sls as $s) {
            $data = array();
            $data["index"] = $i;
            $data["sls_name"] = $s->sls->fullname();
            $data["sls_id"] = $s->sls->long_code;
            $data["map"] = $s->map;
            $data["l1"] = $s->l1;
            $data["l2"] = $s->l2;
            $data["date"] = $s->date;
            $data["sender"] = $s->sender;
            $data["note"] = $s->note;
            $data["id"] = $s->id;
            $slsArray[] = $data;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $slsArray
        ]);
    }
}
