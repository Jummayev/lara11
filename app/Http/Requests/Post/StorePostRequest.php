<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:0', 'max:255'],
            'body' => ['required', 'string', 'min:0'],
            'author_id' => ['required', 'integer', 'min:-9223372036854775808', 'max:9223372036854775807'],
            'status' => ['required', 'integer', 'min:-2147483648', 'max:2147483647'],
            'type' => ['required', 'integer', 'min:-2147483648', 'max:2147483647'],
            'percentage' => ['required', 'numeric'],
            'view_count' => ['required', 'integer', 'min:-9223372036854775808', 'max:9223372036854775807'],
            'publish_at' => ['required', 'date'],
            'slug' => ['required', 'unique:posts,slug'],
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
