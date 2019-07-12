<?php

namespace Grundmanis\Laracms\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class LaracmsPageTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['text', 'url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(LaracmsPage::class, 'laracms_page_id');
    }
}
