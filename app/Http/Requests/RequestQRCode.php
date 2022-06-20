<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestQRCode extends FormRequest
{

    protected $queryParams = [
        'color',
        'bgcolor',
        'size',
        'content',
        'logo',
        'name'
    ];

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
            'content'   => ['required']
        ];

        if (parent::has('size')) {
            $rules['size'] = ['numeric'];
        }

        if (parent::has('color')) {
            $rules['color'] = [new \App\Rules\HexColor];
        }

        if (parent::has('bgcolor')) {
            $rules['bgcolor'] = [new \App\Rules\HexColor];
        }

        if (parent::has('logo') && parent::get('logo')) {
            $rules['logo'] = ['URL', new \App\Rules\IsPNG];
        }

        // if (parent::has('name')) {
        //     $rules['name'] = ['required'];
        // }

        return $rules;
    }

    public function messages()
    {
        return [
            'content.required'  => 'Informe um contéudo para o QRCode, use o parâmetro \'content\'',
            'name.required'     => 'Informe um nome para o QRCode, use o parâmetro \'name\'',
            'size.numeric'      => 'Informe um tamanho para o QRCode, use o parâmetro \'size\''
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success'       => false,
            'message'       => 'Opss.. houve um erro',
            'error'         => $validator->errors()->first()
        ]));
    }
}
