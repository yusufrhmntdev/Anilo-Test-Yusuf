<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $section_header = "Subject Data";
        $subject = Subject::all();
        return view('master_data.subject.subject_data',compact(['section_header','subject']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $section_header = "Create subject";
        return view('master_data.subject.subject_create',compact('section_header'));
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
         Subject::create([
            'id' => $this->id_subject(),
            'name' => $request->nama_subject,
        ]);
        return redirect()->route('subject.index')->with('message','data berhasil di disimpan');
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
        $section_header = "Edit subject";
        $subject = Subject::findOrFail($id);


        return view('master_data.subject.subject_edit',compact(['section_header','subject']));
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
        Subject::where('id',$id)->update([
            'name' => $request->nama_subject,
        ]);

 

        return redirect()->route('subject.index')->with('message','data berhasil di edit');
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
        $subject = Subject::findOrFail($id);
        $subject->delete();
        
        return redirect()->route('subject.index')->with('message','data berhasil di hapus');
    }
    private function right($str, $length)
    {
        return substr($str, -$length);
    }
    
    private function id_subject()
    {
        // Membuat Fungsi Kode karyawan
        $json = DB::table('subjects')
                 ->select(DB::raw('RIGHT(MAX(id), 4) AS lastCount'))
                 ->get();
    
        $lastCount = json_decode($json);
        $lastCount = $lastCount[0]->lastCount;
        $lastCount += 1;
        $lastCount = $this->right('100' . $lastCount, 4);
        // dd($lastCount);
        return $lastCount;
    }
    private function _validation(Request $request)
    {
        $request->validate([

                'nama_subject' => ['required']
        ]);
    }
}
