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

        if ($group_name) {
            if ($group_name=='Special groups'){
                return response()->json([
                    'payload' => DB::table('slides')
                        ->where('slides.group_name', 'Special groups')
                        ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                        ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                        ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                        ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                        ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                        ->select('slides.*', 'special_groups.specimen','box_number.box-number','slide_ceils.ceil_name')
                        ->get()
                ]);
            }

            return response()->json([
                'payload' => DB::table('others')
                    ->where('slides.group_name', '=', $group_name)
                    ->join('slides', 'slides.id', '=', 'others.id')
                    ->join('section_types', 'others.id', '=', 'section_types.other_id')
                    ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                    ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                    ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                    ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                    ->select('slides.*', 'section_types.SectionType','box_number.box-number','slide_ceils.ceil_name','others.family','others.latine_name')
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
