<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="NotebookResource",
 *     description="Notebook resource",
 *     @OA\Xml(
 *         name="NotebookResource"
 *     ),
 * )
 */
class NotebookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->company,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'photo' => $this->photo,
        ];
    }
}
