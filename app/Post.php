<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'wysiwyg_text','status','img_location','type'
    ];
    //
}
