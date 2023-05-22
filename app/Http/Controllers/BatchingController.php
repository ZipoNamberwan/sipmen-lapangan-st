<?php

namespace App\Http\Controllers;

use App\Models\Batching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BatchingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index-batching');
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDataBatching(Request $request)
    {
        $recordsTotal = Batching::where(['user_id' => Auth::user()->id])->count();

        $orderColumn = 'date';
        $orderDir = 'desc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '0' || $request->order[0]['column'] == '1' || $request->order[0]['column'] == '2') {
                //order by sls
            } else if ($request->order[0]['column'] == '3') {
                //box
            } else if ($request->order[0]['column'] == '4') {
                $orderColumn = 'receiver';
            } else if ($request->order[0]['column'] == '5') {
                $orderColumn = 'date';
            }
        }
        $searchkeyword = $request->search['value'];
        $batch = Batching::where(['user_id' => Auth::user()->id])->get();
        if ($searchkeyword != null) {
            $batch = $batch->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->receiving->sls->subdistrict->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->receiving->sls->village->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->receiving->sls->name), strtolower($searchkeyword)) ||
                    Str::contains($q->receiving->sls->long_code, $searchkeyword) ||
                    Str::contains(strtolower($q->receiver), strtolower($searchkeyword));
            });
        }
        $recordsFiltered = $batch->count();

        if ($orderDir == 'asc') {
            $batch = $batch->sortBy($orderColumn);
        } else {
            $batch = $batch->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $batch = $batch->skip($request->start)
                ->take($request->length);
        }

        $batchArray = array();
        $i = $request->start + 1;
        foreach ($batch as $b) {
            $data = array();
            $data["index"] = $i;
            $data["subdistrict"] = $b->receiving->sls->village->subdistrict->name;
            $data["subdistrict_code"] = $b->receiving->sls->village->subdistrict->code;
            $data["village"] = $b->receiving->sls->village->name;
            $data["village_code"] = $b->receiving->sls->village->code;
            $data["sls"] = $b->receiving->sls->name;
            $data["sls_code"] = $b->receiving->sls->code;
            $data["sls_long_code"] = $b->receiving->sls->long_code;
            $data["date"] = $b->date;
            $data["receiver"] = $b->receiver;
            $data["box_no"] = $b->box->number;
            $data["id"] = $b->id;
            $batchArray[] = $data;
            $i++;
        }
        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $batchArray
        ]);
    }
}
