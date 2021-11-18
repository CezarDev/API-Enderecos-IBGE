<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco as Endereco;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Endereco as EnderecoResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\EnderecoRequest;


class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enderecos = Endereco::all();
        return EnderecoResource::collection($enderecos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnderecoRequest $request)
    {
        try {
            $endereco = new Endereco;

            $endereco->logradouro  = $request->input('logradouro');
            $endereco->numero        = $request->input('numero');
            $endereco->bairro           = $request->input('bairro');
            $endereco->cidade_id    = $request->input('cidade_id');

            if ($endereco->save()) {
                return new EnderecoResource($endereco);
            }
        } catch (HttpException $e) {
            $this->response['type']    = 'error';
            $this->response['message'] = $e->getMessage();

            return Response::json($this->response, $e->getStatusCode());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $endereco = Endereco::findOrFail($id);
        return new EnderecoResource($endereco);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnderecoRequest $request, $id)
    {
        $endereco = endereco::findOrFail($id);
        $endereco->logradouro = $request->input('logradouro');
        $endereco->numero       = $request->input('numero');
        $endereco->bairro           = $request->input('bairro');
        $endereco->cidade_id    = $request->input('cidade_id');

        if ($endereco->save()) {
            return new enderecoResource($endereco);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $endereco = Endereco::findOrFail($id);
        if ($endereco->delete()) {
            return new EnderecoResource($endereco);
        }
    }

    public function mostrarEnderecosEcidades(): JsonResponse
    {
        $cadastros = DB::table('enderecos')
            ->join('cidades', 'enderecos.cidade_id', '=', 'cidades.id')
            ->select(
                'enderecos.logradouro',
                'enderecos.numero',
                'enderecos.bairro',
                'cidades.nome AS cidade',
                'cidades.estado'
            )->get();

        return  new JsonResponse($cadastros,  HttpFoundation\Response::HTTP_OK);
    }
}
