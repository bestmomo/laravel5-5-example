<?php

namespace App\Http\Requests;

class CategoryRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->category ? ',' . $this->category->id : '';

        return $rules = [
            'title' => 'bail|required|max:255',
            'slug' => 'bail|required|max:255|unique:categories,slug' . $id,
        ];
    }
}
