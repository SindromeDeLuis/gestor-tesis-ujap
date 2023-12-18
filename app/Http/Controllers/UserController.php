<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use app\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(7);

        return view('admin.usuarios', compact('users'));
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_card' => ['required', 'min:8', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:20'],
            'career' => ['string', 'max:20'],
        ]);


        if ($request->picture_file){
            $file = $request->file('picture_file');
            $fileName = $request->id_card.'.jpg';
            $file->move(public_path('images/profile_pictures/'),$fileName);
        } else {
            $fileName = 'default.gif';
        }

        
        $user = User::create([
            'picture' => $fileName,
            'name' => $request->name,
            'id_card' => $request->id_card,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'career' => $request->career,
        ]);


        /*if(! empty($request->roles)) {
            $user->assignRole($request->roles);
        }*/

        return back()->with('status','Usuario creado con éxito.');
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
        $user = User::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id_card' => ['required', 'string', 'min:8', 'unique:users,id_card,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['string', 'min:8'],
            'role' => ['required', 'string', 'max:20'],
            'career' => ['string', 'max:20'],
        ]);


        if ($request->picture_file){
            $file = $request->file('picture_file');
            $fileName = $request->id_card.'.jpg';
            $file->move(public_path('images/profile_pictures/'),$fileName);
            $user->update([
                'picture' => $fileName
            ]);
        }
        

        $user->update([
            'name' => $request->name,
            'id_card' =>$request->id_card,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if($request->career){
            $user->update([
                'career' => $request->career,
            ]);
        }


        if($request->password){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }


        //$roles = $request->roles ?? [];
        //$user->syncRole($roles);

        
        return back()->with('status','Usuario actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user = User::find($id);
        $user->delete();

        return back()->with('status', 'Usuario eliminado con éxito.');
    }


    public function updatePassword(Request $request){

        /*$request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/
        
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
                'success' => true,
                'message' => '¡Contraseña cambiada con éxito!'
        ]);
    }
}
