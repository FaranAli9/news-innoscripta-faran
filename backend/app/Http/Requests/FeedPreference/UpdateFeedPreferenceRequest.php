<?php

namespace App\Http\Requests\FeedPreference;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedPreferenceRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categories'   => ['nullable', 'array'],
            'categories.*' => ['required', 'integer', 'exists:categories,id'],
            'authors'      => ['nullable', 'array'],
            'authors.*'    => ['required', 'integer', 'exists:authors,id'],
            'sources'      => ['nullable', 'array'],
            'sources.*'    => ['required', 'integer', 'exists:sources,id'],
        ];
    }
}
