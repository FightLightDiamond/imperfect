<?php

namespace Tutorial\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LessonUpdateRequest extends FormRequest
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
            'intro' => 'required',
            'content' => 'required',
            'feature_image' => '',
            'section_id' => '',
            'status' => '',
            'no' => '',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
