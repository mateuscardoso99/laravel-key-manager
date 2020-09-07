<?php

namespace App\Http\Controllers;

use App\Models\Chave;
use App\Models\Porteiro;
use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Aula;

use App\Http\Requests\ChaveRequest;
use App\Http\Requests\IniciarAulaRequest;
use App\Http\Requests\FecharAulaRequest;

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
        $chaves = Chave::where('user_id',$this->user_id)->with('porteiro')->paginate(10);
         $porteiros = Porteiro::where('user_id',$this->user_id)
        ->where('situacao','ativado')->get();
        return view('chave.index',['chaves'=>$chaves,'porteiros'=>$porteiros]);
    }


    /*
     insere uma chave no banco
     */
    public function store(ChaveRequest $request)
    {
        $data = $request->validated();
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
    atualiza uma chave no banco
    */
    public function update(ChaveRequest $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->validated();
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
    public function iniciarAula(IniciarAulaRequest $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->validated();

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
    public function encerrarAula(FecharAulaRequest $request, $id)
    {
        $chave = Chave::find($id);
        $data = $request->validated();

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
