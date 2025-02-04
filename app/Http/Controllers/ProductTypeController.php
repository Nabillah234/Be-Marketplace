<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductType::all();
        return response([
            "message" => "List Product",
            "data" => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'type_name' => 'required|unique:product_types,type_name',
            ],
            [
                'type_name.required' => 'is required',
                'type_name.unique' => 'already exist',
            ]
        );

        ProductType::create([
            'type_name' => $request->type_name,
        ]);

        return response(["message" => "Product Type Created Successfully"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProductType::find($id);
        if (is_null($data)) {
            return response([
                "message" => "ini adalah sebuah method",
                "data" => [],
            ], 404);
        }

        return response([
            "message" => "ini adalah sebuah method",
            "data" => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_name' => 'required|unique:product_types,type_name',
        ]);

        $data = ProductType::find($id);

        if (is_null($data)) {
            return response([
                "message" => "ini adalah sebuah method",
                "data" => [],
            ], 404);
        }


        $data->type_name = $request->type_name;
        $data->save();


        // ProductType::create([
        //     'type_name' => $request->type_name,
        // ]);

        return response(["message" => "Product Type Update Successfully"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProductType::find($id);
        if (is_null($data)) {
            return response([
                "message" => "Product Not available",
                "data" => [],
            ], 404);
        }

        $data->delete();

        return response([
            "message" => "Product Is Deleted Successfully",
            "data" => $data,
        ]);
    }
}