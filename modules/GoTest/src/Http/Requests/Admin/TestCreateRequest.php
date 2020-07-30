<?php

namespace GoTest\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestCreateRequest extends FormRequest
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
            'title' => 'required',
'description' => 'required',
'time' => 'required',
'status' => 'required',


        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
