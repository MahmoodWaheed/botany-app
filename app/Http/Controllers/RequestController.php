<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('slides', 'slides.id', '=', 'requests.slide_id')
            ->select('requests.user_id', 'requests.slide_id', 'users.name as user_name', 'slides.arabicName as slide_name', 'requests.start_date', 'requests.end_date', 'requests.returned_date', 'requests.notes', 'requests.returned_state', 'requests.request_state', 'requests.requested_at', 'requests.updated_at')
            ->get();

        return response()->json($requests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'slide_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        DB::table('requests')->insert($validatedData);

        $request = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('slides', 'slides.id', '=', 'requests.slide_id')
            ->select('users.name as user_name', 'slides.arabicName as slide_name', 'requests.start_date', 'requests.end_date', 'requests.returned_date', 'requests.notes', 'requests.returned_state', 'requests.request_state', 'requests.requested_at', 'requests.updated_at')
            ->where([
                ['requests.user_id', '=', $validatedData['user_id']],
                ['requests.slide_id', '=', $validatedData['slide_id']],
                ['requests.start_date', '=', $validatedData['start_date']],
                ['requests.end_date', '=', $validatedData['end_date']],
            ])
            ->first();

        return response()->json($request, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'slide_id' => 'required|integer',
        ]);

        $request = DB::table('requests')
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('slides', 'slides.id', '=', 'requests.slide_id')
            ->select('requests.id', 'users.name as user_name', 'slides.arabicName as slide_name', 'requests.start_date', 'requests.end_date', 'requests.returnd_date', 'requests.notes', 'requests.returned_state', 'requests.request_state', 'requests.requested_at', 'requests.updated_at')
            ->where('requests.user_id', $validatedData['user_id'])
            ->where('requests.slide_id', $validatedData['slide_id'])
            ->first();

        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }

        return response()->json($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $slide_id)   // chick if returnd state == true cnt ++ 
    {
        $validatedData = $request->validate([   //method to validate the input data. This ensures that the data is in the correct format and meets any validation rules set for each field.
            'start_date' => 'date',
            'end_date' => 'date',
            'notes' => 'nullable|string',
            'returned_state' => 'nullable|boolean',
            'returned_date' => 'nullable|date',
            'request_state' => 'nullable|string|in:approved,rejected',
        ]);

        $updateQuery = DB::table('requests')
            ->where('user_id', $user_id)
            ->where('slide_id', $slide_id);

        foreach ($validatedData as $field => $value) {
            $updateQuery->when($value !== null, function ($query) use ($field, $value) {
                return $query->update([$field => $value]);
            });
        }

        $updatedRequest = DB::table('requests')   //After all fields have been updated, the function retrieves the updated request from the database
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('slides', 'slides.id', '=', 'requests.slide_id')
            ->select('requests.id', 'users.name as user_name', 'slides.arabic_name as slide_name', 'requests.start_date', 'requests.end_date', 'requests.returnd_date', 'requests.notes', 'requests.returned_state', 'requests.request_state', 'requests.requested_at', 'requests.updated_at')
            ->where('requests.user_id', $user_id)
            ->where('requests.slide_id', $slide_id)
            ->first();

        return response()->json($updatedRequest);  // the function returns the updated request as a JSON response.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $slide_id)
    {
        $request = DB::table('requests')
            ->where('user_id', $user_id)
            ->where('slide_id', $slide_id)
            ->first();

        if ($request) {
            // Insert the request into the request_archives table
            DB::table('request_archives')->insert([
                'user_id' => $request->user_id,
                'slide_id' => $request->slide_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'notes' => $request->notes,
                'returned_state' => $request->returned_state,
                'returned_date' => $request->returned_date,
                'request_state' => $request->request_state,
                'requested_at' => $request->requested_at,
                'updated_at' => $request->updated_at,
                'deleted_at' => now(),
            ]);

            // Delete the request from the requests table
            DB::table('requests')
                ->where('user_id', $user_id)
                ->where('slide_id', $slide_id)
                ->delete();

            return response()->json(['message' => 'Request archived successfully.']);
        } else {
            return response()->json(['error' => 'Request not found.'], 404);
        }
    }
}
