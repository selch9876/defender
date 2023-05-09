<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerClass extends FormRequest
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
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'base_health' => 'integer|numeric',
            'base_resistance' => 'integer|numeric',
            'base_attack' => 'integer|numeric',
            'base_defence' => 'integer|numeric',
            'special_ability' => 'required|max:100',
            'thumbnail' => 'image',
        ];
    }
}
