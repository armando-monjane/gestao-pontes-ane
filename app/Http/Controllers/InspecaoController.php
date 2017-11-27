<?php

namespace App\Http\Controllers;

use App\Inspecao;
use App\Problema;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspecaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->request->add(['data' => date("Y-m-d", strtotime(str_replace('/', '-', $request->data)) )]);

        Inspecao::create($request->all());

        return redirect('/inspecoes-history/'.$request->ponte_id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function saveInspecao(Request $request) {
        $inspecao = Inspecao::find($request->id);

        if($inspecao) {
            foreach ($request->problemas as $problema){

                $prob = Problema::find($problema['id']);

                $inspecao->problemas()->attach($prob->id, [
                    'dimensao' => $problema['dimensao'],
                    'nivel_deterioracao' => $problema['nivel_deterioracao'],
                    'nota' => /* $problema['nota'] ? $problema['nota'] : */ '',
                ]);

            }

            $inspecao->data = $request->data ? $request->data : date('Y-m-d');
            $inspecao->comentario = $request->comentario;
            $inspecao->publicada = $request->publicar;
            $inspecao->realizada = true;
            $inspecao->save();

            return response()->json(['msg' => 'Inspeção registada com sucesso']);

        }

    }


    public function inspecoesByUserAPI($id) {

        $inspecoes = Inspecao::where('user_id', $id)->where('realizada', false)->with(['ponte', 'tipo_inspecao'])->get();

        return response()->json(['inspecoes' => $inspecoes->toArray()]);

    }
}
