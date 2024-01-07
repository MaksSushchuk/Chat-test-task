<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'username' => ['bail','required','string','max:36','alpha_num'],
            'email' => ['bail','required', 'email', 'max:36'],
            'captcha' => ['bail','required'],
            'text' => ['bail','required','string','max:255'],
            'parent_id' => ['bail','nullable', 'exists:comments,id'],
            'home_page' => ['bail','nullable','url'],
            'file' => ['bail','nullable','file','max:102400','mimes:jpg,gif,png,txt'],
        ];
    }
}
