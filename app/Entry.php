<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use CrudTrait;
    use SoftDeletes;

    protected $fillable = [
        'novel_id',
        'entry_author_id',
        'order',
        'entry_date',
        'entry',
        'editors_note',
        'font',
        'title',
        'editors_forward'
    ];

    protected $table = 'entries';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $hidden = [];
    protected $dates = [
        'entry_date'
    ];

    public function author()
    {
        return $this->belongsTo(EntryAuthor::class, 'entry_author_id');
    }

    public function novel()
    {
        return $this->belongsTo(Novel::class, 'novel_id');
    }

    public function getFontAttribute($font)
    {
        if ('' == $font) {
            return $this->author->font;
        }
        return $font;
    }

    public function getMyIndex()
    {
        $novel = Novel::find($this->novel->id);
        $entries = $novel->entries()->orderBy('entry_date');
        foreach ($entries->get() as $key => $entry) {
            if ($entry->id === $this->id) {
                return $key;
            }
        }
        return null;
    }
}
