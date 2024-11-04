<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'bail',  // kiem tra loi luon
                'required',
                'string',
                Rule::unique(Course::class)->ignore($this->course),
            ]
        ];
    }


//    doi messages
    public function messages() : array  {
        return [
            'required' => ':attribute bat buoc phai dien',
            'unique'   =>  ':attribute da duoc dung'
        ];
    }

//set thuoc tinh cho attributes
    public function attributes(): array
    {
        return [
            'name' => 'Ten',
        ];
    }
}
