<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'filename',
        'partner',
        'code',
        'type',
        'career',
        'period',
        'tutor',
        'status_tutor',
        'comment_tutor',
        'jury1',
        'jury2',
        'status_jury',
        'comment_jury',
        'status_public',
        'comment_jury',
        'date',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }   
}
