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
                if ($group_name == 'Special groups') {
                    return response()->json([
                        'payload' => DB::table('slides')
                            ->where('slides.group_name', 'Special groups')
                            ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                            ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                            ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                            ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                            ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                            ->select(
                                'slides.id',
                                'slides.arabicName',
                                'slides.count',
                                'slides.slide_number',
                                'slides.cupbord',
                                'slides.english_name',
                                'slides.image',
                                'slides.group_name',
                                'special_groups.specimen',
                                DB::raw('GROUP_CONCAT(DISTINCT box_number.`box-number` ORDER BY box_number.`box-number` SEPARATOR ",") AS box_numbers'),
                                DB::raw('GROUP_CONCAT(DISTINCT slide_ceils.`ceil_name` ORDER BY slide_ceils.`ceil_name` SEPARATOR ",") AS ceil_names')
                            )
                            ->groupBy('slides.id', 'slides.arabicName', 'slides.count', 'slides.slide_number', 'slides.cupbord', 'slides.english_name', 'slides.image', 'slides.group_name', 'special_groups.specimen')
                            ->distinct()
                            ->get()
                    ]);
                }
                
                // return response()->json([
                //     'payload' => DB::table('slides')
                //         ->where('slides.group_name', 'Special groups')
                //         ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                //         ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                //         ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                //         ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                //         ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                //         ->select('slides.id', 'slides.arabicName', 'slides.count', 'slides.slide_number', 'slides.cupbord', 'slides.english_name', 'slides.image', 'slides.group_name', 'special_groups.specimen', /*'box_number.box-number',*/ /*'slide_ceils.ceil_name',*/
                //             DB::raw('GROUP_CONCAT(DISTINCT box_number.`box-number` ORDER BY box_number.`box-number` SEPARATOR ",") AS box_numbers'),
                //             DB::raw('GROUP_CONCAT(DISTINCT slide_ceils.`ceil_name` ORDER BY slide_ceils.`ceil_name` SEPARATOR ",") AS ceil_names')
                //         )
                //         ->groupBy('slides.id', 'slides.arabicName', 'slides.count', 'slides.slide_number', 'slides.cupbord', 'slides.english_name', 'slides.image', 'slides.group_name', 'special_groups.specimen', 'box_number.box-number', 'slide_ceils.ceil_name')
                //         ->distinct()
                //         ->get()
                // ]);
                // return response()->json([
                //     'payload' => DB::table('slides')
                //         ->where('slides.group_name', 'Special groups')
                //         ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                //         ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                //         ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                //         ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                //         ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                //         ->select('*'/*, 'special_groups.specimen','box_number.box-number','slide_ceils.ceil_name'*/)
                //         ->get()
                // ]);
                // return response()->json([
                //     'payload' => DB::table('slides')
                //         ->where('slides.group_name', 'Special groups')
                //         ->join('special_groups', 'slides.id', '=', 'special_groups.id')
                //         ->join('slide_box_numbers', 'slide_box_numbers.slide_id', '=', 'slides.id')
                //         ->join('box_number', 'slide_box_numbers.box_number_id', '=', 'box_number.id')
                //         ->join('slide_slide_ceils', 'slide_slide_ceils.slide_id', '=', 'slides.id')
                //         ->join('slide_ceils', 'slide_slide_ceils.slide_ceils_id', '=', 'slide_ceils.id')
                //         ->select('*')
                //         ->distinct()
                //         ->get()
                // ]);
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
                    ->select(
                        'slides.id',
                        'slides.arabicName',
                        'slides.count',
                        'slides.slide_number',
                        'slides.cupbord',
                        'slides.english_name',
                        'slides.image',
                        'slides.group_name',
                        'section_types.SectionType',
                        'others.family',
                        'others.latine_name',
                        DB::raw('GROUP_CONCAT(DISTINCT box_number.`box-number` ORDER BY box_number.`box-number` SEPARATOR ",") AS box_numbers'),
                        DB::raw('GROUP_CONCAT(DISTINCT slide_ceils.`ceil_name` ORDER BY slide_ceils.`ceil_name` SEPARATOR ",") AS ceil_names')
                    )
                    ->groupBy('slides.id', 'slides.arabicName', 'slides.count', 'slides.slide_number', 'slides.cupbord', 'slides.english_name', 'slides.image', 'slides.group_name', 'section_types.SectionType', 'others.family', 'others.latine_name')
                    ->distinct()
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
