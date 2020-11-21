<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeRecentReplied($query)
    {
        return $query->orderByDesc('updated_at');
    }
    public function scopeRecent($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function scopeWithOrder($query,$order)
    {
        switch ($order){
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
    }

    public function link($param=[])
    {
        return route('topics.show',array_merge([$this->id,$this->slug]),$param);
    }

    public function updateReplyCount()
    {
        $this->reply_count=$this->replies->count();
        $this->save();
    }
}
