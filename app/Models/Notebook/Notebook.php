<?php

namespace App\Models\Notebook;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     title="Notebook",
 *     description="Notebook model",
 *     @OA\Xml(
 *         name="Notebook"
 *     )
 * )
 */

class Notebook extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['deleted_at'];

    public $timestamps = false;
}
