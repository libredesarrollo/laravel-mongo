<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBook extends FormRequest
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
        return $this->myRules();
    }

    public function myRules(){
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'category_id' => 'required',
            'age' => 'required|integer',
            'price' => 'required|numeric',
            'type' => 'required|string',
            'classification' => 'required',
        ];
    }
}
