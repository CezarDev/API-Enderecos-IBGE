<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Dotenv\Parser\Value;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Cidade extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($cidades)
    {
        return [
            'id'                   => $this->id,
            'nome'            => $this->nome,
            'estado'          => $this->estado,
        ];
    }
}
