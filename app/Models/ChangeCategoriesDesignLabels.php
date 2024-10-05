<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeCategoriesDesignLabels extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'change_categories_design_labels';
    protected $primaryKey = 'change_categories_design_label_id';
}
