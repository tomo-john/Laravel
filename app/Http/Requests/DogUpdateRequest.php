<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DogUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        $dog = $this->role('dog');
        return $this->user()->can('update', $dog);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:100'],
            'color' => ['required', 'in:' . implode(',', array_keys(config('dog.colors')))],
            'favorite_food' => ['nullable', 'string', 'max:30'],
        ];
    }
}
