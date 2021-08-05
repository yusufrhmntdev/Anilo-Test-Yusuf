<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $section_header = "Student Data";
        $student = Student::all();
        return view('master_data.student.student_data',compact(['section_header','student']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $section_header = "Create Student";
        return view('master_data.student.student_create',compact('section_header'));

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
        $a = Student::create([
            'id' => $this->id_student(),
            'name' => $request->nama_student,
        ]);

        // dd($a);

        return redirect()->route('student.index')->with('message','data berhasil di simpan');
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
        $section_header = "Edit Student";
        $student = Student::findOrFail($id);


        return view('master_data.student.student_edit',compact(['section_header','student']));
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
       Student::where('id',$id)->update([
            'name' => $request->nama_student,
        ]);

 

        return redirect()->route('student.index')->with('message','data berhasil di edit');
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
        $student = Student::findOrFail($id);
        $student->delete();
        
        return redirect()->route('student.index')->with('message','data berhasil di hapus');
    }
    private function right($str, $length)
    {
        return substr($str, -$length);
    }
    
    private function id_student()
    {
        // Membuat Fungsi Kode karyawan
        $json = DB::table('students')
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

                'nama_student' => ['required']
        ]);
    }
}
