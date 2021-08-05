<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $section_header = "Score Data";
        $score = Score::all();
        return view('master_data.score.score_data',compact(['section_header','score']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $student = Student::all();
        $subject = Subject::all();
        $section_header = "Create score";
        return view('master_data.score.score_create',compact(['section_header','student','subject']));
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
        $this->_validation($request);
        Score::create([
           'student_id' => $request->student_id,
           'subject_id' => $request->subject_id,
           'score' => $request->score,
       ]);
       return redirect()->route('score.index')->with('message','data berhasil di disimpan');
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
        $student = Student::all();
        $subject = Subject::all();
        $section_header = "Edit score";
        $score = Score::findOrFail($id);


        return view('master_data.score.score_edit',compact(['section_header','score','student','subject']));
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
        $this->_validation($request);
        Score::where('id',$id)->update([
            'student_id'=>$request->student_id,
            'subject_id'=> $request->subject_id,
            'score' => $request->score,
        ]);

 

        return redirect()->route('score.index')->with('message','data berhasil di edit');
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
        $score = Score::findOrFail($id);
        $score->delete();
        
        return redirect()->route('score.index')->with('message','data berhasil di hapus');
    }
    private function _validation(Request $request)
    {
        $request->validate([

                'student_id' => ['required'],
                'subject_id' => ['required'],
                'score'     => ['required']
        ]);
    }
}
