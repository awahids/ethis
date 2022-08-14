<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $respone = [
            'message' => 'Get All tags successfully',
            'data' => $tags
        ];

        return response()->json($respone, Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $tag = Tag::create($request->all());
            $respone = [
                'message' => 'Tag created successfully',
                'data' => $tag
            ];
            return response()->json($respone, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Tag not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $findTag = Tag::find($id);
        if (!$findTag) {
            return response()->json(['message' => 'Tag not found'], Response::HTTP_NOT_FOUND);
        }

        $respone = [
            'message' => 'Get Tag successfully',
            'data' => $findTag
        ];

        return response()->json($respone, Response::HTTP_OK);
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
        $findTag = Tag::find($id);
        if (!$findTag) {
            return response()->json(['message' => 'Tag not found'], Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $findTag->update($request->all());
            $respone = [
                'message' => 'Tag updated successfully',
                'data' => $findTag
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Tag not updated'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findTag = Tag::find($id);
        if (!$findTag) {
            return response()->json(['message' => 'Tag not found'], Response::HTTP_NOT_FOUND);
        }
        try {
            $findTag->delete();
            $respone = [
                'message' => 'Tag deleted successfully',
                'data' => $findTag
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Tag not deleted'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
