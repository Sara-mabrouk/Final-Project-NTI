<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = "tasks";

    protected $fillable = ["title","content","image"];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {

        return url('images/' . $this->image);

    }

}
