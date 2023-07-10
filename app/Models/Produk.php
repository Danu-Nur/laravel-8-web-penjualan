<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori_produks()
    {
        return $this->BelongsTo(Kategori_produk::class);
    }

    public function users()
    {
        return $this->BelongsTo(User::class);
    }
}
