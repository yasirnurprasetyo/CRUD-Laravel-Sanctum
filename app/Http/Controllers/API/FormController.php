<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlpn' => 'required'
        ]);

        // dd($request->all());
        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_tlpn = $request->no_tlpn;
        $student->save();

        return response()->json([
            'message' => 'Create Data Student Success',
            'students' => $student
        ], 200);
    }

    public function edit($id)
    {
        $student = Student::find($id);
        // dd($student);

        return response()->json([
            'message' => 'Get Data Student for Update Success',
            'students' => $student
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlpn' => 'required'
        ]);
        $student->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_tlpn' => $request->no_tlpn
        ]);
        return response()->json([
            'message' => 'Update Data Student Success',
            'students' => $student
        ], 200);
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();
        // dd($student);

        return response()->json([
            'message' => 'Delete Data Student Success',
            // 'students' => $student
        ], 200);
    }
}
