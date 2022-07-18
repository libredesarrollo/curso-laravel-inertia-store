<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table="contact_persons";

    protected $fillable=['name','surname','other','contact_general_id','choices'];

    public function general()
    {
        return $this->belongsTo(ContactGeneral::class,'contact_general_id');
    }
}
