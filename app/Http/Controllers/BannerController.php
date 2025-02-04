<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $data = Banner::all();
        return response([
            "massage" => "product type list",
            "data" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // $time = Carbon::now();
        // $doc = str_replace(" ", "-", $time) . '.' . $request->profile_picture->extension();
        // $request->file("profile_picture")->move(public_path("upload/profile"), $doc);

        $imagename = time() . '.' . $request->banner_url->extension();
        $request->banner_url->move(public_path('image'), $imagename);

        Banner::create([
            'banner_url' => url('image/' . $imagename),
            'banner_url_name' => $imagename,

        ]);

        return response(["massage" => "Banner  created successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Banner::find($id);

        if (is_null($data)) {
            return response([
                "massage" => "Banner type not found",
                "data" => [],
            ], 404);
        }
        return response([
            "massage" => "product type list",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'banner_url' => 'required|image|mimes:jpeg,pg,jpg,gif,svg|max:2048',
    ]);

    $data = Banner::find($id);
    if (is_null($data)) {
        return response([
            "message" => "Banner not found",
            "data" => [],
        ], 404);
    }


    $imagename = time() . '.' . $request->banner_url->extension();
    $request->banner_url->move(public_path('image'), $imagename);

    $data->banner_url = url('image/' . $imagename);
    $data->banner_url_name = $imagename;
    $data->save();

    return response([
        "message" => "Banner updated successfully",
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Banner::find($id);

        if (is_null($data)) {
            return response([
                "massage" => "Banner type not found",
                "data" => [],
            ], 404);
        }

        $data->delete();

        return response([
            "massage" => "product type deleted",
            "data" => $data,
        ]);
    }    
}