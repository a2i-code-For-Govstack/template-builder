<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\User;

class Form extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function category_type()
    {
        return $this->belongsTo(Category::class,'category');
    }

    public function created_form()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function updated_form()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}
