<?php

namespace App\Http\Controllers;

use App\Events\Sharing\CreateSharingContentFailedEvent;
use App\Events\Sharing\CreateSharingContentSucceededEvent;
use App\Events\Sharing\ViewSharingContentFailedEvent;
use App\Events\Sharing\ViewSharingContentSucceededEvent;
use App\Models\Sharing;
use App\Models\Viewers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SharingController extends Controller
{
    public function detail($id, Request $request)
    {
        if (!Uuid::isValid($id)) {
            abort(404);
        }
        if (!Sharing::where('sharing_id', $id)->exists()) {
            abort(404);
        }

        $data = Sharing::where('sharing_id', $id)
            ->where('view_mode', '!=', 'private')
            ->first();
        
        if ($data->view_mode == 'secret') {
            $lockStatus = true;

            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'secret_code' => 'required|string|min:1'
                ]);
        
                if ($validator->fails()) {
                    event(new ViewSharingContentFailedEvent([
                        'requests' => $request->all()
                    ], 'Error validation', 400, $request->ip()));
                    
                    return redirect()->back()
                        ->withErrors($validator->errors()->first());
                }

                $secretCode = $request->input('secret_code');

                if ($data->secret_code === preg_replace('/\s+/', '', $secretCode)) {
                    $lockStatus = false;

                    event(new ViewSharingContentSucceededEvent([
                        'requests' => $request->all()
                    ], 200, $request->ip()));

                    (new Viewers())->watch($data->id, $request->server('HTTP_REFERER'), $request->ip());
                } else {
                    event(new ViewSharingContentFailedEvent([
                        'requests' => $request->all()
                    ], 'Wrong secret code', 400, $request->ip()));

                    return redirect()->back()
                        ->withErrors('Wrong secret code');
                }
            }
        } else {
            $lockStatus = false;

            event(new ViewSharingContentSucceededEvent([
                'requests' => $request->all()
            ], 200, $request->ip()));
            (new Viewers())->watch($data->id, $request->server('HTTP_REFERER'), $request->ip());
        }

        return view('sharing.detail', compact('lockStatus', 'id', 'data'));
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
            ->where('listing_mode', true)
            ->whereBetween('created_at', [$startDate.' 00:00:00', $endDate.' 23:59:59']);

        if ($request->filled('q')) {
            $searchQuery = $request->get('q');

            $sharing->where(function ($query) use ($searchQuery) {
                $query->where('title', 'ILIKE', "%{$searchQuery}%");
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
                $query->where('title', 'ILIKE', "%{$searchQuery}%");
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
            event(new CreateSharingContentFailedEvent([
                'requests' => $request->all()
            ], 'Error validation', 400, $request->ip()));

            return redirect()->route('sharing.create-new')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $uuid = Str::uuid()->toString();
            $data = [
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
            ];
            $sharing = new Sharing($data);
            $sharing->save();

            event(new CreateSharingContentSucceededEvent([
                'requests' => $request->all(),
                'store'    => $data
            ], 200, $request->ip()));

            return redirect()->route('sharing.detail', $sharing->sharing_id)
                ->with('success', 'Your new sharing content is published!');
        } catch (\Throwable $e) {
            event(new CreateSharingContentFailedEvent([
                'requests' => $request->all()
            ], $e->getMessage(), 500, $request->ip()));

            return redirect()->route('sharing.create-new')
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function edit()
    {
        return view('sharing.edit');
    }

    public function update(Request $request)
    {
        // to-do
    }
}
