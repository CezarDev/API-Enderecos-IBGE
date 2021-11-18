<?php

namespace App\Http\Controllers;

use App\Models\Cidade as Cidade;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Resources\Cidade as CidadeResource;

class CidadeController extends Controller
{

    public function index()
    {
        $cidades = Cidade::all();
        return CidadeResource::collection($cidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $url = env('URL_IBGE');
        $response = Http::get($url);
        $cidades = $response->json();

        try {
            foreach ($cidades as $dado) {
                $cidade = new Cidade;
                $cidade->nome   = $dado['nome'];
                $cidade->estado = $dado['microrregiao']['mesorregiao']['UF']['sigla'];

                $cidade->save();
            }
        } catch (HttpException $e) {
            DB::rollBack();
            $this->response['type']    = 'error';
            $this->response['message'] = $e->getMessage();

            return  Response($this->response, $e->getStatusCode());
        }
        return  new JsonResponse($cidades,  HttpFoundation\Response::HTTP_OK);
    }
}
