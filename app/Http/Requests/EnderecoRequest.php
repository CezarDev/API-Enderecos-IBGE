<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnderecoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logradouro' => 'required|max:100',
            'numero' => 'required|integer|max:9999',
            'bairro' => 'required|max:50',
            'cidade_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            "logradouro.required" => trans('exception.endereco.campo_obrigatorio'),
            "numero.required" => trans('exception.endereco.campo_obrigatorio'),
            "bairro.required" => trans('exception.endereco.campo_obrigatorio'),
            "cidade_id.required" => trans('exception.endereco.campo_obrigatorio')
        ];
    }
}
