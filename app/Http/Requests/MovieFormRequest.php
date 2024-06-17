<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'genre_code' => 'required|in:ACTION,ADVENTURE,ANIMATION,BIOGRAPHY,COMEDY,COMEDY-ACTION,COMEDY-ROMANCE,CULT,DRAMA,FAMILY,FANTASY,HISTORY,HORROR,MYSTERY,MUSICAL,ROMANCE,SCI-FI,SUPERHERO,THRILLER,WAR,WESTERN',
            'year' => 'required|integer|between:1,9999',
            'trailer_url' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'poster' => 'sometimes|image|mimes:png|max:4096', // maxsize = 4Mb
        ];
        return $rules;
    }
    public function messages(): array
    {
        return [
            'year.required' => 'Year is required',
            'year.integer' => 'Year must be an integer',
            'year.between' => 'Year must be between 1 and 9999',
        ];
    }
}
