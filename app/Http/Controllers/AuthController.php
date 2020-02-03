<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DataTables;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }  
 
    public function registration() {
        return view('registration');
    }
     
    public function postLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (\Auth::attempt([
            'email' => $request->email,
            'password' => $request->password])
        ){
            return redirect('/dashboard');
        }
        return redirect('/login')->with('error', 'Oppes! You have entered invalid credentials');
    }
 
    public function postRegistration(Request $request) {  
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->add($data);
        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard(Request $request) {
        if(Auth::check()){
            if ($request->ajax()) {
                $data = User::latest()
                ->whereNull('deleted_at')
                ->where('id', '!=', auth()->user()->id)->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="/edit/user/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm">Edit</a>';
                            $btn = $btn.'<button type="button" name="delete" id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                            return $btn;
 
                     })
                    ->rawColumns(['action'])
                    ->make(true);
            }
          
            return view('dashboard');
        }
        return Redirect::to("login");
    }
 
    public function add(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function create() {
        return view('user.create');
    }

    public function edit($id) {
        $user = User::where('id', $id)->first();
        return view('user.edit', compact('user', 'id'));
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json(['success'=>'User deleted successfully.']);
    }

    public function update(Request $request, $id) {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return redirect("dashboard");
    }
}
