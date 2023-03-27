<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group_name = request()->group_name;

        if ($group_name=='Special groups'){
            return response()->json([
                'payload' => DB::table('slides')
                    ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                    ->select('slides.*', 'special_groups.specimen')
                    ->where('slides.group_name', '=', $group_name)
                    ->get()
            ]);
        }
        elseif(($group_name=='Phycology')||($group_name=='Archegoniate')||($group_name=='Gymnosperm')||($group_name=='Monocotyledon')||($group_name=='Dicotyledon')||($group_name=='Fossil')){
            return response()->json([
                'payload' => DB::table('slides')
                    ->join('others', 'slides.id', '=', 'others.id')
                    ->join('section_types', 'others.id', '=', 'section_types.other_id')
                    ->where('slides.group_name', '=', $group_name)
                    ->get()

            ]);
        }

        // password should be hashed not encrypt 
        return response()->json([
            'payload' => DB::table('slides')->get()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_slides_by_group($group_name)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
