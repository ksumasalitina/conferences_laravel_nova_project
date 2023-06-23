<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
            'user_id'=>['required'],
            'meeting_id'=>['required'],
            'slot_id'=>['required'],
            'theme'=>['required', 'min:2', 'max:255'],
            'description'=>['required', 'max:1000'],
            'presentation'=>['file','max:10240','nullable','mimes:ppt,pptx']
        ];
    }
}
