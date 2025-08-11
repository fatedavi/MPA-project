<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'position',
        'base_salary',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function events()
{
    return $this->belongsToMany(Event::class, 'event_attendances');
}

}
