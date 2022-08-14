<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topic = Topic::all();
        $respone = [
            'message' => 'Get All topic successfully',
            'data' => $topic
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
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $topic = Topic::create($request->all());
            $respone = [
                'message' => 'Topic created successfully',
                'data' => $topic
            ];
            return response()->json($respone, Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Topic not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $findTopic = Topic::find($id);
        if (!$findTopic) {
            return response()->json(['message' => 'Topic not found'], Response::HTTP_NOT_FOUND);
        }

        $respone = [
            'message' => 'Get topic successfully',
            'data' => $findTopic
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
        $findTopic = Topic::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        try {
            $findTopic->update($request->all());
            $respone = [
                'message' => 'Topic updated successfully',
                'data' => $findTopic
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Topic not updated'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $findTopic = Topic::findOrFail($id);
        try {
            $findTopic->delete();
            $respone = [
                'message' => 'Topic deleted successfully',
                'data' => $findTopic
            ];
            return response()->json($respone, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Topic not deleted'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
