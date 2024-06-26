<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
            'name' => 'required|string|max:45',
            'password' => 'required|string|max:45',
            'email' => 'required|string|email|max:45|unique:users,email',
            'phone' => 'required|string|max:45|unique:users,phone',
            'type' => 'required|string|max:45',
            'ssn' => 'required|string|max:45|unique:users,ssn',
            'id' => 'required|integer'
        ]);
        // $validatedData['password'] = Hash::make($validatedData['password']); hassing the password

        // $validatedData['last_activity'] = Carbon::now(); // Set the last activity timestamp
    
        $user = User::create($validatedData);
        return response()->json($user, 201);  // we use user function to tell the front end that we already store this user 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => "User with ID $id not found."], 404);
        }
    }
    /**
     * Get the number of users currently using the app.
     *
     * @return \Illuminate\Http\Response
     */
    // public function countActiveUsers()
    // {
    //     $count = User::where('last_activity', '>=', Carbon::now()->subMinutes(15))->count();
    //     return response()->json(['Total Users' => $count], 200);
    // }

    public function countUsers()
    {
        $count = User::count();
        return response()->json(['Total Users ' => $count], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:45',
            'password' => 'sometimes|string|max:45',
            'email' => 'sometimes|string|email|max:45|unique:users,email,' . $user->id . ',id',
            'phone' => [
                'sometimes',
                'string',
                'regex:/^(?:\+?20|0)?1[0-9]{9}$/',
                'max:45',
                'unique:users,phone,' . $user->id . ',id',
            ],
            'type' => 'sometimes|string|max:45',
            'ssn' => 'sometimes|string|max:45|unique:users,ssn,' . $user->id . ',id',
            'blocked' => 'sometimes|boolean',
        ]);
        // if (isset($validatedData['password'])) {
        //     $validatedData['password'] = Hash::make($validatedData['password']);  hashing the password
        // }

        $user->update($validatedData);
        return response()->json($user, 203);
    }
    public function getUserTypeByEmail(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:45',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'the user deleted successfully !']);
    }
}
