<?php

namespace App\Http\Requests;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userId = auth()->user()->id;
        $categoryId = $this->segment(2);
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
            'name' => 'required|max:25'
        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'Имя категории обязательно к заполнению',
            'name.max' => 'Имя категории не более 25 символов',
        ];
    }
}
