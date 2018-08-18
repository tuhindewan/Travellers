<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use App\User;

class PersonalInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','checkstatus']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.profile_settings.personal_information');
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
        $input  = $request->all();


        // Validate the data

        $inspiration = $input['inspiration'];



        if(count(explode(' ', $inspiration)) > 250){
            return redirect()->back()->with('error','The Inspiration Must Be Less Than 250 Words');
        }

        try {

            $id = PersonalInformation::create($input);
            $bug = 0;

        } catch (Exception $e) {

            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            
        }

        if($bug == 0){
            
            return redirect()->back()->with('success','Your Inspiration Has Been Saved Successfully.');
        }else{
            return redirect()->back()->with('error','Something Went Wrong !, Please Try Again.'.$bug1);
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
        //
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
        $input = $request->all();
        $inspiration = $input['inspiration'];

        if(count(explode(' ', $inspiration)) > 250){
            return redirect()->back()->with('error','The Inspiration Must Be Less Than 250 Words');
        }

        try {

            $id = PersonalInformation::updateInformation($input,$id);
            $bug = 0;

        } catch (Exception $e) {

            $bug = $e->errorInfo[1];
            $bug1 = $e->errorInfo[2];
            
        }

        if($bug == 0){
            
            return redirect()->back()->with('success','Your Inspiration Has Been Saved Successfully.');
        }else{
            return redirect()->back()->with('error','Something Went Wrong !, Please Try Again.'.$bug1);
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
        //
    }
}
