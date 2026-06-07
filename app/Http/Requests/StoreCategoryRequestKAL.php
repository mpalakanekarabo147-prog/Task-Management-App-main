<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequestKAL extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Models\CategoryKAL::class) ?? false;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:80', 'unique:categories,name'],
            'color' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter a category name.',
            'name.unique' => 'That category already exists.',
            'color.required' => 'Please choose a category color.',
        ];
    }
}
