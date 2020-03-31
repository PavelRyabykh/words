<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class CreateWordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userId = auth()->user()->id;
        $categoryId = $this->input('category_id');
        return Category::where('id', $categoryId)->where('user_id', $userId)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'word' => 'required|max:25',
            'transcription' => 'required|max:25',
            'translation' => 'required|max:25',
            'example' => 'required|max:400',
        ];
    }
}
