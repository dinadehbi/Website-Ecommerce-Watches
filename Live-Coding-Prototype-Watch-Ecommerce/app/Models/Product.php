<?php

// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Déclare les champs qui peuvent être remplis
    protected $fillable = [
        'title', 'content', 'price', 'stock' 
    ];
}
