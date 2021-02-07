<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public $guarded = [];

    // public function user() {
    //     return $this->belongsTo(User::class,'uid','id')->withDefault([
    //         'name'=> 'Guest User'
    //     ]);
    // }
    public function category() {
        return $this->belongsTo(Category::class, 'category_id' , 'id');
    }

    // public function tags() {
    //     return $this->belongsToMany(Tag::class,'post_tag','tag_id','post_id');
    // }
}
