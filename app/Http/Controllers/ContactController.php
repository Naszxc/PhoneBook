<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    //

    public function index(){
        return view('index');
    }

    public function store(Request $request){

        $request->validate([
            'phone_number' => ['regex:/^[0-9]{10}$/','required'],
            'fname' => ['regex:/^[a-zA-Z ]+$/', 'required'],
            'lname' => ['regex:/^[a-zA-Z ]+$/', 'required'],
            'mname' => ['regex:/^[a-zA-Z ]+$/', 'required']
        ],[
            'fname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required',
            'lname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required',
            'mname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required'
        ]);

        $user = '';

            DB::transaction(function() use($request, &$user){
                $user = Contact::create([
                    'phone_number' => "0" . $request->phone_number,
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'mname' => $request->mname
                ]);
            });

        return response()->json(['message' => 'success', 'data' => $user]);
    }

    public function fetch(){
        return Contact::orderBy('fname', 'asc')->get();
    }

    public function destroy($value){
        $user=Contact::find($value);
        $user->delete();

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request, $id){

        $request->validate([
            'phone_number' => ['regex:/^[0-9]{10}$/','required'],
            'fname' => ['regex:/^[a-zA-Z ]+$/', 'required'],
            'lname' => ['regex:/^[a-zA-Z ]+$/', 'required'],
            'mname' => ['regex:/^[a-zA-Z ]+$/', 'required']
        ],[
            'fname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required',
            'lname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required',
            'mname.regex' => 'Numbers are not allowed',
            'fname.required' => 'This field is required'
        ]);

        $data = Contact::find($id);
        $data->update([
            'phone_number' => "0" . $request->phone_number,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mname' => $request->mname
        ]);

        return response()->json(['message' => $data]);
    }
}
