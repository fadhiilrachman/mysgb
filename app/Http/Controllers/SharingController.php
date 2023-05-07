<?php

namespace App\Http\Controllers;

use App\Models\Sharing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SharingController extends Controller
{
    public function detail($id)
    {
        if (!Uuid::isValid($id)) {
            abort(404);
        }
        if (!Sharing::where('sharing_id', $id)->exists()) {
            abort(404);
        }

        $data = Sharing::where('sharing_id', $id)->first();

        return view('sharing.detail', compact('data'));
    }

    public function list()
    {
        return view('sharing.list');
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

        $sharing = Sharing::select('sharing_id', 'title', 'user_id', 'created_at')
            ->whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59']);

        if ($request->filled('q')) {
            $searchQuery = $request->get('q');

            $sharing->where(function ($query) use ($searchQuery) {
                $query->where('title', 'ILIKE', "%{$searchQuery}%")
                    ->orWhere('created_by', 'ILIKE', "%{$searchQuery}%");
            });
        }

        return DataTables::of($sharing)
            ->addColumn('title_with_link', function ($row) {
                return '<a href="'.route('sharing.detail', ['id'=>$row->sharing_id]).'">'.$row->title.'</a>';
            })
            ->editColumn('user_id', function ($row) {
                $author = $row->author;

                return $author->name;
            })
            ->editColumn('created_at', function ($row) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at, 'UTC')
                    ->setTimezone('Asia/Jakarta');

                return $date->diffForHumans();
            })
            ->rawColumns(['title_with_link'])
            ->toJson();
    }

    public function myList()
    {
        return view('sharing.my-list');
    }

    public function myListAjax(Request $request)
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

        $sharing = Sharing::select('sharing_id', 'title', 'created_at')
            ->where('user_id', Auth::id())
            ->whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59']);

        if ($request->filled('q')) {
            $searchQuery = $request->get('q');

            $sharing->where(function ($query) use ($searchQuery) {
                $query->where('title', 'ILIKE', "%{$searchQuery}%")
                    ->orWhere('created_by', 'ILIKE', "%{$searchQuery}%");
            });
        }

        return DataTables::of($sharing)
            ->addColumn('title_with_link', function ($row) {
                return '<a href="'.route('sharing.detail', ['id'=>$row->sharing_id]).'">'.$row->title.'</a>';
            })
            ->editColumn('created_at', function ($row) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at, 'UTC')
                    ->setTimezone('Asia/Jakarta');

                return $date->diffForHumans();
            })
            ->rawColumns(['title_with_link'])
            ->toJson();
    }

    public function create()
    {
        return view('sharing.create-new');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:4',
            'description' => 'required|min:5',
            'body' => 'required|min:10',
            'labels' => 'required|min:1',
            'view_mode' => 'required|in:public,private,secret,club,inner',
            'listing_mode' => 'required|in:yes,no',
            'secret_code' => 'required_if:view_mode,==,secret',
            'expired_at' => 'datetime',
        ]);
        if ($validator->fails()) {
            return redirect()->route('sharing.create-new')
                ->withErrors($validator)
                ->withInput();
        }

        $uuid = Str::uuid()->toString();
        $sharing = new Sharing([
            'sharing_id' => $uuid,
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'body' => $request->input('body'),
            'labels' => json_encode($request->input('labels')),
            'view_mode' => $request->input('view_mode'),
            'listing_mode' => $request->input('listing_mode')=='yes'?true:($request->input('listing_mode')=='no'?false:true),
            'secret_code' => $request->input('secret_code') ?? null,
            'expired_at' => $request->input('expired_at') ?? null
        ]);
        $sharing->save();

        return redirect()->route('sharing.detail', $sharing->sharing_id)
            ->with('success', 'Your new sharing content is published!');
    }

    public function edit()
    {
        return view('sharing.edit');
    }

    public function update(Request $request)
    {

    }
}