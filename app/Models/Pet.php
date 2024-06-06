<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'born',
    'type',
    'vaccines',
    'user_id',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
