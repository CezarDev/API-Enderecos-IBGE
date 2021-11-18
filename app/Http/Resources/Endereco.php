<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Endereco extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //  return parent::toArray($request);
        return [
            'id'                   => $this->id,
            'logradouro' => $this->logradouro,
            'numero'        => $this->numero,
            'bairro'            => $this->bairro,
            'cidade_id'     => $this->cidade_id
        ];
    }
}
