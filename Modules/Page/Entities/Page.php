<?php

namespace Modules\Page\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;

class Page extends Model
{
    use Translatable, Sluggable, HasMetaData;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'body', 'slug'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addActiveGlobalScope();
    }

    public static function urlForPage($id)
    {
        return static::select('page_translations.*')
            ->join('page_translations', 'pages.id', '=', 'page_translations.page_id')
            ->where('page_translations.locale', locale())
            ->firstOrNew(['pages.id' => $id])->url();
    }

    public function url()
    {
        if (is_null($this->slug)) {
            return '#';
        }

        return localized_url(locale(), $this->slug);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new AdminTable($this->newQuery()->withoutGlobalScope('active'));
    }

    public function getUrls()
    {
        $routeArray = [];
        foreach (supported_locales() as $locale => $language) {
            $slugTranslated = $this->getSlugTranslated($this, PageTranslation::class, $locale);
            $routeArray[$locale] = $slugTranslated->slug;
        }
        return $routeArray;
    }
}
