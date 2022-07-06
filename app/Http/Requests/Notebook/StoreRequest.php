<?php

namespace App\Http\Requests\Notebook;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="StoreRequest",
 *      description="Store request body data",
 *      type="object",
 *      required={"name", "phone_number", "email"}
 * )
 */

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|max:255',
            'company' => 'string|max:255|nullable',
            'phone_number' => 'string|required|max:255',
            'email' => 'email|required|max:255',
            'birthdate' => 'date_format:Y-m-d|nullable',
            'photo' => 'file|nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
