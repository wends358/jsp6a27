<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Product extends Model
{
 use HasFactory;
 protected $fillable = [
 'code',
 'name',
 'quantity',
 'price',
 'description',
 'image'
 ];
}
