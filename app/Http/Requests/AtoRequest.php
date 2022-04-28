<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AtoRequest extends FormRequest
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
        $rules = [
            'nr_ato' => 'required|unique:tb_ato',
            'ds_descricao' => 'required|unique:tb_ato',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules = [];
        }
        return $rules;

    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nr_ato.required' => 'Número do ato é obrigatório!',
            'nr_ato.unique' => 'Número do ato já existe!',
            'ds_descricao.required' => 'Descrição do ato é obrigatória!',
            'ds_descricao.unique' => 'Descrição do ato já existe!',
        ];
    }

}
