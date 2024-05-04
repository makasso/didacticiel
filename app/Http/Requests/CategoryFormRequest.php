<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
            ],
            'image'=>[
                'mimes:jpg,jpeg,png',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champs nom est requis',
            'name.string' => 'Le champs nom doit être du texte',
            'description.required' => 'Le champs description est requis',
            'image.mimes' => 'L\'image doit être un fichier de type jpg, jpeg ou png',
        ];
    }
}
