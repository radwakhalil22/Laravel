<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory,SoftDeletes,Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image',
    ];

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'deleted_at' => 'date:Y-m-d',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function setImageAttribute($value){
        $imageName = time(). '.' . $value->getClientOriginalExtension();
        $value->storeAs('public/images/posts',$imageName);
        $this->attributes['image'] = 'storage/images/posts/'. $imageName;
    }
}
