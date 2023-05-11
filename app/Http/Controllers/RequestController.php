<?php

namespace App\Http\Controllers;

use App\Mail\RequestAccepted;
use App\Mail\RequestReceived;
use App\Mail\RequestRejected;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all requests and their associated user and slide data
        $requests = DB::table('requests')
        ->join('users', 'requests.user_id', '=', 'users.id')
        ->join('slides', 'requests.slide_id', '=', 'slides.id')
        ->select('users.id','users.email','users.name','slides.arabicName',
                'slides.english_name','requests.requested_at','requests.updated_at',
                'requests.end_date','requests.slide_id','requests.returned_state',
                'requests.returned_date','requests.start_date','requests.notes')
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $requests
        ]);
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
            'returned_date' => 'nullable|date',
            'notes' => 'nullable|string|max:255',
            'returned_state' => 'nullable|boolean',
            'request_state' => 'nullable|string|max:45'
        ]);

        DB::table('requests')->insert($validatedData);

        $request2 = DB::table('requests')
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

        $user = DB::table('users')->where('id', $validatedData['user_id'])->first();
        $slide = DB::table('slides')->where('id', $validatedData['slide_id'])->first();

       Mail::to($user->email)->send(new RequestReceived($user, $slide));  // Send email to user 

        return response()->json($request2, 201);
    }



    // function to send mail to user tellin the user to come in order to take its slide in spicific time in case of aproved 

    // function to send mail to user tellin user that its request is rejected in case of request rejected 
    
    

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

        return response()->json([
            'status' => 'success',
            'data' => $request
        ]);
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
        // $user_id = request()->user_id;
        // $slide_id = request()->slide_id;
        $validatedData = $request->validate([   //method to validate the input data. This ensures that the data is in the correct format and meets any validation rules set for each field.
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'returned_date' => 'nullable|date',
            'notes' => 'nullable|string|max:255',
            'returned_state' => 'nullable|boolean',
            /*'request_state' => 'nullable|string|max:45'*/
        ]);

        $updateQuery = DB::table('requests')
            ->where('user_id', $user_id)
            ->where('slide_id', $slide_id);

        foreach ($validatedData as $field => $value) {
            $updateQuery->when($value !== null, function ($query) use ($field, $value) {
                return $query->update([$field => $value]);
            });

        $updatedRequest = DB::table('requests')   //After all fields have been updated, the function retrieves the updated request from the database
            ->join('users', 'users.id', '=', 'requests.user_id')
            ->join('slides', 'slides.id', '=', 'requests.slide_id')
            ->select('requests.id', 'users.name as user_name', 'slides.arabic_name as slide_name', 'requests.start_date', 'requests.end_date', 'requests.returnd_date', 'requests.notes', 'requests.returned_state', 'requests.request_state', 'requests.requested_at', 'requests.updated_at')
            ->where('requests.user_id', $user_id)
            ->where('requests.slide_id', $slide_id)
            ->first();

        // Update slide count based on returned_state value
        $slide = DB::table('slides')->where('id', $slide_id)->first();

        if ($updatedRequest->returned_state) {
            DB::table('slides')->where('id', $slide_id)->update(['cont' => $slide->cont + 1]);
        } else {
            DB::table('slides')->where('id', $slide_id)->update(['cont' => $slide->cont - 1]);
        }
        

            $currentRequestState = $updatedRequest->request_state;

            // // send email if request is rejected
            // if ($currentRequestState === 'reject') {
            //     $user = User::findOrFail($user_id);
            //     Mail::to($user->email)->send(new RequestRejected($updatedRequest));
            // }
        
            // // send email if request is accepted
            // if ($currentRequestState === 'accept') {
            //     $user = User::findOrFail($user_id);
            //     Mail::to($user->email)->send(new RequestAccepted($updatedRequest));
            // }

        return response()->json($updatedRequest);  // the function returns the updated request as a JSON response.
    }

    public function acceptRequest(Request $request){
               
        // dd($user_id,$slide_id);
        $user_id = request()->user_id;
        $slide_id = request()->slide_id;
        $requestData = DB::table('requests')
            ->where('requests.user_id','=', $user_id)
            ->where('requests.slide_id','=', $slide_id)
            ->first();

        // update the request again 
        $updateQuery = DB::table('requests')
            ->where('requests.user_id','=', $user_id)
            ->where('requests.slide_id','=', $slide_id)
            ->update(['requests.request_state'=>'approved','updated_at'=>now()]);

            // send email if request is accepted
            $user = User::findOrFail($user_id);
            Mail::to($user->email)->send(new RequestAccepted($user_id,$slide_id));

    }

    public function rejectRequest(Request $request){
 
        $user_id = request()->user_id;
        $slide_id = request()->slide_id;
        // update the request again 
        $requestData = DB::table('requests')
            ->where('user_id', $user_id)
            ->where('slide_id', $slide_id)
            ->first();

        $updateQuery = DB::table('requests')
            ->where('user_id', $user_id)
            ->where('slide_id', $slide_id)
            ->update(['request_state'=>'reject','updated_at'=>now()]);

            // send email if request is rejected
            $user = User::findOrFail($user_id);
            Mail::to($user->email)->send(new RequestRejected($user_id,$slide_id));
            $this->destroy($user_id, $slide_id);  //i need to call the destroy function 
        
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
            $archived = DB::table('request_archives')->insert([
                'users_id' => $request->user_id,
                'slides_id' => $request->slide_id,
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

            if (!$archived) {
                return response()->json(['message' => 'Failed to archive the request.'], 500);
            }

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
