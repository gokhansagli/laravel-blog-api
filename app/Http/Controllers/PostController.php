<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Post::all();   
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Post::create([
            "title" => $request->title,
            "content" => $request->content,
            "author" => $request->author
        ]);

        

        return response()->json([
            "success" => true,
            "message" => "Post başarılı bir şekilde oluşturuldu.",
            "data" => $data
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Post::find($id);

        if($data){
            $data["success"] = true;
            $data["message"] = "Başarılı";

            return response()->json($data,200);
        }else{
            return response()->json([
                "success" => false,
                "message" => "Aranan kayıt bulunamadı."
            ],404);
        }

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        

        try {
            $post = Post::findOrFail($id);

        $post->update([
            "title" => $request->title,
            "content" => $request->content,
            "author" => $request->author
        ]);


        return response()->json([
            "success" => true,
            "message" => "Post başarıyla güncellendi.",
            "data" => $post
        ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                "message" => "Post güncellenirken bir sorun oluştu."
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
