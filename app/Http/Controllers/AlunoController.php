<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
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
        $alunos = Aluno::where('user_id',$this->user_id)->with('professor')->get();
        return view('aluno.index',['alunos'=>$alunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profs = Professor::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        return view('aluno.create',['profs'=>$profs]);
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
        Aluno::create([
            'nome' => $data['nome'],
            'curso' => $data['curso'],
            'id_professor' => $data['sel_professores'],
            'user_id' => $this->user_id,
        ]);
        return redirect()->route('aluno.index');
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
        $aluno = Aluno::find($id);
        if($aluno){
            if($aluno->situacao === 'ativado'){
                $aluno->situacao = 'desativado';
                $aluno->save();
            }
            else if ($aluno->situacao === 'desativado') {
                $aluno->situacao = 'ativado';
                $aluno->save();
            }
          
        }
        return redirect()->route('aluno.index');
    }



    public function edit($id)
    {
        $aluno = Aluno::find($id);
        $profs = Professor::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        if($aluno){
            return view('aluno.update',
                ['aluno'=>$aluno,'profs'=>$profs]
            );
        }
        return redirect()->route('aluno.index');
    }


    public function update(Request $request, $id)
    {
        $aluno = Aluno::find($id);
        $data = $request->all();
        if ($aluno) {
            $aluno->nome = $data['nome'];
            $aluno->curso = $data['curso'];
            $aluno->id_professor = $data['sel_professores'];
            $aluno->save();
        }
        return redirect()->route('aluno.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $aluno = Aluno::find($id);
        if($aluno){
            $aluno->delete();
        }
        return redirect()->route('aluno.index');
    }
}
