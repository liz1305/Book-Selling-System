<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author','description','price','image','user_id','condition','stock','slug'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
