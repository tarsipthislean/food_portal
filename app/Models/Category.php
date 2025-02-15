<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // ✅ ตรวจสอบให้ตรงกับฐานข้อมูล
    protected $fillable = ['name', 'status']; // ✅ ต้องกำหนดค่า Fillable
}
