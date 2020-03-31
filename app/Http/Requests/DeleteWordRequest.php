<?php

namespace App\Http\Requests;

use App\Category;
use App\Word;
use Illuminate\Foundation\Http\FormRequest;

class DeleteWordRequest extends FormRequest
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
        $wordId = $this->segment(2);
        return Category::where('id', $categoryId)->where('user_id', $userId)->exists() &&
            Word::where('id', $wordId)->where('category_id', $categoryId)->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
