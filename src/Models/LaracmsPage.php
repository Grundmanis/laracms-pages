<?php

namespace Grundmanis\Laracms\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class LaracmsPage extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['text', 'url'];

    protected $fillable = ['layout', 'key', 'in_footer', 'in_top_nav', 'auth_only'];

    /**
     * LaracmsPage constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return env('APP_URL') . '/' . $this->url;
    }
}
