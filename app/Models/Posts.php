<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function getPostList($srchList)
    {
        $postList = $this
        ->select(
            'posts.id',
            'posts.post_title',
            'posts.image_name',
            'posts.post_content',
            'posts.is_publish',
            DB::raw('DATE_FORMAT(posts.create_datetime, "%d/%m/%Y") as create_datetime')
        )->when(isset($srchList['srchPostTitle']), function($query) use ($srchList) {
            $query->where('posts.post_title', 'LIKE', "%". $srchList['srchPostTitle'] ."%");
        })
        ->orderBy('posts.id', 'desc');

        return $postList;
    }
}
