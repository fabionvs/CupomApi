<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'nr_cnpj' => 'required|unique:tb_empresa',
            'nm_nome' => 'required|unique:tb_empresa',
            'email' => 'required|unique:tb_users',
        ];
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
            'nr_cnpj.required' => 'Número do CNPJ obrigatório!',
            'nr_cnpj.unique' => 'CNPJ é único!',
            'email.required' => 'Email é obrigatória!',
            'email.unique' => 'Email já existe!',
            'nm_nome.required' => 'Nome é obrigatório!',
            'nm_nome.unique' => 'Nome já existe!',
        ];
    }

}
