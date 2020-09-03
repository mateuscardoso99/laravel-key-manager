<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    protected $user_id;

    public function __construct(){
        $this->middleware('auth');

        $this->middleware(function($request,$next){
            $this->user_id = Auth::id();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profs = Professor::where('user_id',$this->user_id)->get();
        return view('professor.index',['profs'=>$profs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Professor::create([
            'nome' => $data['nome'],
            'graduacao' => $data['graduacao'],
            'user_id' => $this->user_id,
        ]);
        return redirect()->route('professor.index');
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function changeSituacao($id)
    {
        $prof = Professor::find($id);
        if($prof){
            if($prof->situacao === 'ativado'){
                $prof->situacao = 'desativado';
                $prof->save();
            }
            else if ($prof->situacao === 'desativado') {
                $prof->situacao = 'ativado';
                $prof->save();
            }
          
        }
        return redirect()->route('professor.index');
    }



    public function edit($id)
    {
        $prof = Professor::find($id);
        if($prof){
            return view('professor.update',['prof'=>$prof]);
        }
        return redirect()->route('professor.index');
    }


    public function update(Request $request, $id)
    {
        $prof = Professor::find($id);
        $data = $request->all();
        if ($prof) {
            $prof->nome = $data['nome'];
            $prof->graduacao = $data['graduacao'];
            $prof->save();
        }
        return redirect()->route('professor.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $prof = Professor::find($id);
        if($prof){
            $prof->delete();
        }
        return redirect()->route('professor.index');
    }
}
