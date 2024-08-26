<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProducto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'cart_productos';

    protected $fillable = ['cantidad', 'descuento']; 

}
