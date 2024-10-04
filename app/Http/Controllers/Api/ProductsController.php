<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::latest()->paginate(5);

        $response = [
            'message' => 'List all products',
            'data' => $products,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|integer',
        'product'=> 'required|min:2|unique:products',
        'description' => 'required',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }

        $products = products::create([
            'category' => $request->category,
        ]);


        //response
        $response = [
            'status'   => 'Success',
            'message'   => 'Add category success',
            'data'      => $products,
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          //find Chategory by ID
          $products = products::find($id);


          //response
          $response = [
              'success'   => 'detail chategory found',
              'data'      => $products,
          ];


          return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //validasi data
         $validator = Validator::make($request->all(),[
            'category' => 'required|unique:categories|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }

        $products = products::create([
            'category' =>$request->category,
            'product' => $request->input( 'bola basket'),
        ]);

        //response
        $response = [
            'status' =>'success',
            'success' => 'Add products success',
            'data' => $products,
        ];

        return response()->json($response, 201);


        //response
        $response = [
            'success'   => 'Update products success',
            'data'      => $category,
        ];


        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
         //find products by ID
         $products = products::find($id)->delete();


         $response = [
             'success'   => 'Delete Products Success',
         ];


         return response()->json($response, 200);
    }
}
