<?php

namespace App\Http\Controllers;

use App\Models\Chave;
use App\Models\Porteiro;
use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Aula;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\AulaController;

class ChaveController extends Controller
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
     retorna a view index com as chaves cadastradas
     */
    public function index()
    {
        $chaves = Chave::where('user_id',$this->user_id)->with('porteiro')->get();
        return view('chave.index',['chaves'=>$chaves]);
    }

    /*
     retorna a view de create para criar uma chave
     */
    public function create()
    {
        $porteiros = Porteiro::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        return view('chave.create',['porteiros'=>$porteiros]);
    }

    /*
     insere uma chave no banco
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Chave::create([
            'sala' => $data['sala'],
            'id_porteiro' => $data['sel_porteiros'],
            'user_id' => $this->user_id,
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


    /*
     ativa ou desativa a chave com base na situação atual
     */

    public function changeSituacao($id)
    {
        $chave = Chave::find($id);
        if($chave){
            if($chave->situacao === 'ativado'){
                $chave->situacao = 'desativado';
                $chave->save();
            }
            else if ($chave->situacao === 'desativado') {
                $chave->situacao = 'ativado';
                $chave->save();
            }
          
        }
        return redirect()->route('chave.index');
    }


    /*
    retorna a view para edição de uma chave
    */
    public function edit($id)
    {
        $chave = Chave::find($id);
        $porteiros = Porteiro::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        if($chave){
            return view('chave.update',
                ['chave'=>$chave,'porteiros'=>$porteiros]
            );
        }
        return redirect()->route('chave.index');
    }


    /*
    atualiza uma chave no banco
    */
    public function update(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();
        if ($chave) {
            $chave->sala = $data['sala'];
            $chave->id_porteiro = $data['sel_porteiros'];
            $chave->save();
        }
        return redirect()->route('chave.index');
        
    }

    /**
     * Remove uma chave do banco de dados
     */
    public function delete($id)
    {
        $chave = Chave::find($id);
        if($chave){
            $chave->delete();
        }
        return redirect()->route('chave.index');
    }


    /*
    redireciona para a view correta com base na situação da chave
    */
    public function managerChave($id)
    {
        $chave = Chave::find($id);

        if($chave){

            if ($chave->situacao === 'liberada') {
                $porteiros = Porteiro::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();

                $professores = Professor::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();

                $alunos = Aluno::where('user_id',$this->user_id)
                ->where('situacao','ativado')->get();
        
                return view('chave.liberar',
                    [
                        'chave'=>$chave,
                        'porteiros'=>$porteiros,
                        'professores'=>$professores,
                        'alunos'=>$alunos
                    ]
                );
            }
            else{
                return view('chave.devolver',['chave'=>$chave]);
            }
            
        }

        return redirect()->route('chave.index');
    }


    /*
    insere uma nova aula no banco e atualiza a situação da chave
    */
    public function iniciarAula(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();

        if ($chave) {
            DB::transaction(function() use($data, $chave){
                $aula = app()->call('App\Http\Controllers\AulaController@store',['chave_id'=>$chave->id,'data'=>$data]);

                $chave->situacao = 'ocupada';
                $chave->save();
            });
        }
        return redirect()->route('chave.index');
    }


    /*
    atualiza o status da aula no banco e atualiza a situação da chave
    */
    public function encerrarAula(Request $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->all();

        if ($chave) {
            DB::transaction(function() use($data, $chave){
                $aula = app()->call('App\Http\Controllers\AulaController@update',['chave_id'=>$chave->id,'data'=>$data]);

                $chave->situacao = 'liberada';
                $chave->save();
            
            });
        }
        return redirect()->route('chave.index');
    }


    //RELATÓRIOS:
    public function chavesDevolvidas(){
        $aulasdealunos = Aula::whereNull('id_professor')
        ->where('status','encerrada')
        ->where('user_id',$this->user_id)
        ->with(['chave','aluno'])
        ->get();

        $aulasdeprofs = Aula::whereNull('id_aluno')
        ->where('status','encerrada')
        ->where('user_id',$this->user_id)
        ->with(['chave','professor'])
        ->get();

        $all = Aula::whereNotNull('id_aluno')
        ->whereNotNull('id_professor')
        ->where('status','encerrada')
        ->where('user_id',$this->user_id)
        ->with(['chave','professor','aluno'])->get();

        return view('relatorios.chavesdevolvidas',
         [
            'aulasdealunos' => $aulasdealunos,
            'aulasdeprofs' => $aulasdeprofs,
            'all' => $all
        ]);
    }

    public function chavesSituacao(){
        $chavesliberadas = Chave::where('user_id',$this->user_id)
        ->where('situacao','liberada')
        ->with('porteiro')
        ->get();

        $chavesocupadas = Aula::where('status','em andamento')
        ->where('user_id',$this->user_id)
        ->with(['chave','aluno','professor'])
        ->get();

        return view('relatorios.situacao',
         [
            'chavesliberadas' => $chavesliberadas,
            'chavesocupadas' => $chavesocupadas
        ]);
    }

}
