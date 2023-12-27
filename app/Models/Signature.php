<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    public function Students()
    {
        return $this->belongsToMany(Student::class, 'signature_student');
    }

    public function Professors()
    {
        return $this->belongsToMany(Professor::class, 'professor_signature');
    }
}
