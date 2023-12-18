<?php

namespace App\Http\Controllers;

use App\Models\Tesis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $students = User::where('role','Estudiante')
                        ->where('career', Auth::user()->career)
                        ->where('id','!=',Auth::user()->id)
                        ->orderBy('name')
                        ->get();

        $teachers = User::where('role','Docente')
                        ->where('career', Auth::user()->career)
                        ->orderBy('name')
                        ->get();

        return view('alumno.tomo', compact('students', 'teachers'));
    }


    public function indexTutor()
    {
        $tutors = Tesis::where('tutor','=',Auth::user()->name)->paginate(7);

        return view('docente.tutor', compact('tutors'));
    }


    public function indexJurado()
    {
        $juries = Tesis::where('status_tutor','Aprobado')
                        ->where(function ($query) {
                            $query->where('jury1','=',Auth::user()->name)
                                  ->orWhere('jury2','=',Auth::user()->name);
                        })
                        ->paginate(7);

        return view('docente.jurado', compact('juries'));
    }


    public function indexDirector()
    {
        $directors = Tesis::where('career','=',Auth::user()->career)
                        ->where('status_jury','Aprobado')
                        ->paginate(7);

        return view('director.director', compact('directors'));
    }


    public function indexCalendar()
    {
        if (Auth::user()->role === 'Docente') {
            $public_teses = Tesis::where('career','=',Auth::user()->career)
                                ->where('status_public','Publicado')
                                ->where(function ($query) {
                                    $query->where('jury1','=',Auth::user()->name)
                                            ->orWhere('jury2','=',Auth::user()->name)
                                            ->orWhere('tutor','=',Auth::user()->name);
                                })
                                ->get();
            $users = User::where('career','=',Auth::user()->career)
                        ->where('role','=','Estudiante')
                        ->get();
        } elseif (Auth::user()->role === 'Director') {
            $public_teses = Tesis::where('career','=',Auth::user()->career)
                                ->where('status_public','Publicado')
                                ->get();
            $users = User::where('career','=',Auth::user()->career)
                        ->where('role','=','Estudiante')
                        ->get();
        } elseif (Auth::user()->role === 'Administrador') {
            $public_teses = Tesis::where('status_public','Publicado')
                                ->get();
            $users = User::where('role','=','Estudiante')
                        ->get();
        }
        
        return view('calendar', compact('public_teses', 'users'));
    }


    public function indexHome()
    {
        $public_teses = Tesis::where('status_public','Publicado')
                            ->get();
        $users = User::where('role','=','Estudiante')
                    ->get();
                            
        return view('home', compact('public_teses', 'users'));
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
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('trabajos'),$fileName);

        $count = Tesis::where('type',$request->type)->count();

        $tesis = Tesis::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'filename' => $fileName,
            'code' => $request->period.'-'.($count+1).'-'.$request->type,
            'partner' => $request->partner,
            'type' => $request->type,
            'career' => Auth::user()->career,
            'tutor' => $request->tutor,
            'jury1' => $request->jury[0],
            'jury2' => $request->jury[1],
            'period' => $request->period,
        ]);
        
        /*$fileUpload = new Tesis();
        $fileUpload->filename = $fileName;
        $fileUpload->save();*/
        return redirect()->route('tomo')
                        ->with('status','Trabajo guardado con éxito.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tesis  $tesis
     * @return \Illuminate\Http\Response
     */
    public function show(Tesis $tesis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tesis  $tesis
     * @return \Illuminate\Http\Response
     */
    public function edit(Tesis $tesis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tesis  $tesis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tesis = Tesis::find($id);

        if ($request->status_tutor){
            $tesis->update([
                'status_tutor' => $request->status_tutor,
                'comment_tutor' =>$request->comment_tutor,
            ]);
        } elseif($request->status_jury){
            $tesis->update([
                'status_jury' => $request->status_jury,
                'comment_jury' =>$request->comment_jury,
            ]);
        } elseif($request->status_public){
            $tesis->update([
                'status_public' => $request->status_public,
                'comment_director' =>$request->comment_director,
                'date' => $request->date,
            ]);
        }
        

        return back()->with('status','Estado actualizado con exito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tesis  $tesis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tesis $tesis)
    {
        //
    }
}
