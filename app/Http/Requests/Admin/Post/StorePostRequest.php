<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
            'title_en' => ['required', 'string', 'unique:posts,title_en', 'max:300'],
            'content_en' => ['required', 'string'],
            'type_id' => ['required', 'exists:types,id'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'dimensions:min_width=400,min_height=400'],
            'title_ar' => ['nullable', 'string', 'unique:posts,title_ar', 'max:300'],
            'content_ar' => [$this->filled('title_ar') ? 'required' : 'nullable', 'string'],
        ];
    }
}
