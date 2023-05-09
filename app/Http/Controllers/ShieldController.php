<?php

namespace App\Http\Controllers;

use App\Events\Shield\BuildClientShieldFailedEvent;
use App\Events\Shield\BuildClientShieldSucceededEvent;
use App\Models\Clients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ShieldController extends Controller
{
    public function list()
    {
        return view('shield.list');
    }

    public function listAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            'q' => 'sometimes|string|min:1',
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

        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $clients = Clients::select('client_id', 'client_name', 'created_at')
            ->where('user_id', Auth::id())
            ->whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59']);

        if ($request->filled('q')) {
            $searchQuery = $request->get('q');

            $clients->where(function ($query) use ($searchQuery) {
                $query->where('client_name', 'ILIKE', "%{$searchQuery}%");
            });
        }

        return DataTables::of($clients)
            ->addColumn('client_name_with_link', function ($row) {
                return '<a href="'.route('shield.detail', ['id'=>$row->client_id]).'">'.$row->client_name.'</a>';
            })
            ->editColumn('created_at', function ($row) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);

                return $date->diffForHumans();
            })
            ->rawColumns(['client_name_with_link'])
            ->toJson();
    }

    public function build()
    {
        return view('shield.build-new');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|min:4',
            'max_devices' => 'required|min:1|max:100|integer',
            'guard_mode' => 'required|in:public,private',
            'expired_time' => 'required|in:1d,3d,5d,1w,1m,never',
        ]);
        if ($validator->fails()) {
            event(new BuildClientShieldFailedEvent([
                'requests' => $request->all()
            ], 'Error validation', 400, $request->ip()));

            return redirect()->route('sharing.create-new')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $uuid = Str::uuid()->toString();
            $data = [
                'client_id' => $uuid,
                'user_id' => Auth::id(),
                'client_name' => $request->input('client_name'),
                'guard_mode' => $request->input('guard_mode'),
                'max_devices' => $request->input('max_devices'),
                'expired_at' => $request->input('expired_time')
            ];
            $client = new Clients($data);
            $client->save();

            event(new BuildClientShieldSucceededEvent([
                'requests' => $request->all(),
                'store'    => $data
            ], 200, $request->ip()));

            return redirect()->route('shield.detail', ['id' => $client->client_id])
                ->with('success', 'Your new client shield has been built!');
        } catch (\Throwable $e) {
            event(new BuildClientShieldFailedEvent([
                'requests' => $request->all()
            ], $e->getMessage(), 500, $request->ip()));

            return redirect()->route('shield.build-new')
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function detail($id, Request $request)
    {
        if (!Uuid::isValid($id)) {
            abort(404);
        }
        if (!Clients::where('client_id', $id)->exists()) {
            abort(404);
        }

        $data = Clients::where('client_id', $id)
            ->first();
        
        return view('shield.detail', compact('id', 'data'));
    }
}
