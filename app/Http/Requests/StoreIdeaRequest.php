<?php

namespace App\Http\Requests;

use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;

class StoreIdeaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => ['required', 'integer'],
            'title' => ['required', 'min:4'],
            'description' => ['required', 'min:4'],
        ];
    }

    public function validate(): array
    {
        return array_merge(
            parent::validated(),
            [
                'user_id' => auth()->id(),
                'status_id' => Status::OPEN
            ]
        );
    }
}
