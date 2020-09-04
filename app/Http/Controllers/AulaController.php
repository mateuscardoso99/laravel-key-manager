<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Chave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AulaController extends Controller
{
    protected $user_id;


    /* pegando o id do usuário logado */

    public function __construct(){
        $this->middleware('auth');

        $this->middleware(function($request,$next){
            $this->user_id = Auth::id();
            return $next($request);
        });
    }

    /*
     retorna a view index com as aulas cadastrados
     */
    public function index()
    {
        $aulas = Aula::where('user_id',$this->user_id)
        ->with('chave')->get();
        return view('aula.index',['aulas'=>$aulas]);
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

    
    /*
     insere uma aula no banco
     */
    public function store($data, $chave_id)
    {
        Aula::create([
             'id_chave' => $chave_id,
             'id_porteiro' => $data['sel_porteiros'],
             'id_aluno' => $data['sel_alunos'],
             'id_professor' => $data['sel_professores'],
             'data_inicio' => $data['data'],
             'user_id' => Auth::id()
         ]);
        return redirect()->route('chave.index');
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

    
    /*
    atualiza uma aula no banco
    */
    public function update($data, $chave_id)
    {
        $aula = Aula::where('id_chave',$chave_id)->
        where('status','em andamento')->first();
       
        if($aula){
            $aula->data_fim = $data['data'];
            $aula->status = 'encerrada';
            $aula->save();
        }
        return redirect()->route('chave.index');
    }

    
    /**
     * Remove uma aula do banco de dados
     */
    public function delete($id)
    {
        $aula = Aula::find($id);
        $chave = Chave::find($aula->id_chave);

        if($aula){
            if ($chave->situacao === 'ocupada') {
                DB::transaction(function() use($aula,$chave){
                    $aula->delete();
                    $chave->situacao = 'liberada';
                    $chave->save();
                });
            }
            else{
                $aula->delete();
            }
        }
        return redirect()->route('aula.index');
    }
}
