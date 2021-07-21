<?php

namespace App\Models\Admin;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [
        'activity_id', 'percentage', 'observation', 'feedback', 'file',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}
