<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Scores;
use App\Models\Student;
use Illuminate\Http\Request;

class ScoresController extends Controller
{
    public function create(Request $request)
    {
        // dd($request);
        $student = new Student();
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_tlpn= $request->no_tlpn;
        $student->save();

        foreach ($request->list_pelajaran as $key => $value){
            // dd($value);
            $score = array(
                'student_id' => $student->id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai']
            );
            $score = Scores::create($score);
        }

        return response()->json([
            'message' => 'Create Data Score Success'
        ], 200);
    }

    public function getStudent($id)
    {
        $student = Student::with('score')->where('id', $id)->first();
        return response()->json([
            'message' => 'Success',
            'data_student' => $student
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->update([
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "no_tlpn" => $request->no_tlpn
        ]);

        Scores::where('student_id', $id)->delete();

        foreach ($request->list_pelajaran as $key => $value){
            // dd($value);
            $score = array(
                'student_id' => $id,
                'mata_pelajaran' => $value['mata_pelajaran'],
                'nilai' => $value['nilai']
            );
            $score = Scores::create($score);

            return response()->json([
                'message' => 'Success'
            ], 200);
        }
    }
}
