<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeCategoriesDesign extends Model
{
    use HasFactory;

    protected $table = 'change_categories_designs';

    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id', 'user_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'user_id');
    }

    public function labels()
    {
        return $this->hasManyThrough(Label::class, ChangeCategoriesDesignLabels::class, 'design_id', 'label_id', 'design_id', 'label_id');
    }
}
