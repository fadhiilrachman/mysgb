<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function view()
    {
        return view('history.view');
    }

    public function listAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start' => 'required|numeric',
            'length' => 'required|numeric|in:10,25,50,100',
            'draw' => 'required|numeric',
            'columns' => 'required',
            'order' => 'required',
            'search' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 500);
        }

        $logs = LogActivity::select('status_code', 'type', 'ip', 'created_at')
            ->where('created_by', Auth::id())
            ->get();

        return DataTables::of($logs)
            ->editColumn('created_at', function ($row) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);

                return $date->diffForHumans();
            })
            ->toJson();
    }

    public function detail($id)
    {
        if (!LogActivity::whereId($id)->exists()) {
            abort(404);
        }

        return view('history.detail', ['id'=>$id]);
    }
}
