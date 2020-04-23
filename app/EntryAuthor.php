<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryAuthor extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $fillable = [
        'name', 'font',
    ];

    protected $table = 'entry_authors';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
