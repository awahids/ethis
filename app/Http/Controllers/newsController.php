<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        $respone = [
            'message' => 'Get All news successfully',
            'data' => $news
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
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,deleted'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $news = News::create($request->all());
            $respone = [
                'message' => 'News created successfully',
                'data' => $news
            ];
            return response()->json($respone, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'News not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $findNews = News::find($id);
        if (!$findNews) {
            return response()->json(['message' => 'News not found'], Response::HTTP_NOT_FOUND);
        }

        $respone = [
            'message' => 'Get news successfully',
            'data' => $findNews
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
        $findNews = News::findOrFail($id);
        if (!$findNews) {
            return response()->json(['message' => 'News not found'], Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,deleted'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $findNews->update($request->all());
            $respone = [
                'message' => 'News updated successfully',
                'data' => $findNews
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'News not updated'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $findNews = News::findOrFail($id);
        if (!$findNews) {
            return response()->json(['message' => 'News not found'], Response::HTTP_NOT_FOUND);
        }
        try {
            $findNews->delete();
            $respone = [
                'message' => 'News deleted successfully',
                'data' => $findNews
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'News not deleted'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
