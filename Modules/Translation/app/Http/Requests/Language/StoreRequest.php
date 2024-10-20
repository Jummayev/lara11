<?php

namespace Modules\Translation\app\Http\Requests\Language;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Translation\app\Models\Language;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'code' => ['required', 'string', 'unique:languages,code'],
            'status' => ['required', 'in:'.Language::STATUS_ACTIVE.','.Language::STATUS_INACTIVE],
            'is_default' => ['nullable', 'boolean'],
            'icon_id' => ['nullable', 'integer'],
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
