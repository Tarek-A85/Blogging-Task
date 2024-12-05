<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title_en' => ['required', 'string', Rule::unique('posts', 'title_en')->ignore($this->post->id), 'max:300'],
            'content_en' => ['required', 'string'],
            'type_id' => ['required', 'exists:types,id'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'dimensions:min_width=400,min_height=400'],
            'title_ar' => ['nullable', 'string', Rule::unique('posts', 'title_ar')->ignore($this->post->id), 'max:300'],
            'content_ar' => [$this->filled('title_ar') ? 'required' : 'nullable', 'string'],
        ];
    }
}
