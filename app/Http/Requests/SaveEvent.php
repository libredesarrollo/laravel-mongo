<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEvent extends FormRequest
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
    static public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'text_color' => 'required',
            'color_bg' => 'required',
            'start' => 'required',
            'end' => 'string',
            'allday' => 'required',
        ];
    }
}
