<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class TaskStoreRequest extends FormRequest
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
    public function rules()
{
    $rules = [
        'title' => ["required", "min:3", Rule::unique('tasks', 'title')],
        "description" => ["required", "min:10"],
        ];

    // if ($this->isMethod('PUT')) {
    //     $rules['title'][] = Rule::unique('posts')->ignore($this->route('post'));
    // }

    return $rules;
}
    public function messages(){
        return[
            "title.required"=>'you should enter value in title section',
            "description.required"=>'you should enter value in description section'
        ];
    }

}
