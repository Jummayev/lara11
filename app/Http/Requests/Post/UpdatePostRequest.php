<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'min:0', 'max:255'],
            'body' => ['nullable', 'string', 'min:0'],
            'author_id' => ['nullable', 'integer', 'min:-9223372036854775808', 'max:9223372036854775807'],
            'status' => ['nullable', 'integer', 'min:-2147483648', 'max:2147483647'],
            'type' => ['nullable', 'integer', 'min:-2147483648', 'max:2147483647'],
            'percentage' => ['nullable', 'numeric'],
            'view_count' => ['nullable', 'integer', 'min:-9223372036854775808', 'max:9223372036854775807'],
            'publish_at' => ['nullable', 'date'],
            'slug' => ['nullable', 'unique:posts,slug'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
