<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderFormRequest extends FormRequest
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
            //
            'module_id'=>[
                'required',
                'integer'
            ],
            'name'=>[
                'required',
                'string'
            ],
            'description'=>[
                'required',
                'string'
            ],
            'image'=>[
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],
            'videos'=>[
                'nullable',
                //'mimes:mp4,ogx,oga,ogv,ogg,webm'
            ],

            'is_introduction' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le champs nom est requis',
            'name.string' => 'Le champs nom doit être du texte',
            'description.required' => 'Le champs description est requis',
            'is_introduction.required' => 'Le champs définir comme introduction est requis',
        ];
    }
}
