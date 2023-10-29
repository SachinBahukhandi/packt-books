<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /**
         * For updating the book
         */
        if ($this->book) {
            return [
                'title' => 'required|max:255',
                'genre' => 'required|string',
                'author' => 'required',
                'isbn' => 'required|string|unique:books,isbn,'.$this->book->id,
                'image' => 'filled|string|url',
            ];
        } else {
            return [
                'title' => 'required|unique:books|max:255',
                'genre' => 'required|string',
                'author' => 'required',
                'isbn' => 'required|string|unique:books',
                'image' => 'filled|string|url',
            ];
        }
    }
}
