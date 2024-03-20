<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormUpdateLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'sid',
        'template_type',
        'font_type',
        'paper_size',
        'page_type',
        'background_image',
        'image_transparacy',
        'content',
        'category',
        'created_by',
        'updated_by',
        'is_editable',
    ];
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
