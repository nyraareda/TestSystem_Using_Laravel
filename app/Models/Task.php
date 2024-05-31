<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_id');
    }
    
}