<?php

namespace Modules\Brand\Entities;

use Illuminate\Support\Facades\Cache;
use Modules\Brand\Admin\BrandTable;
use Modules\Media\Eloquent\HasMedia;
use Modules\Media\Entities\File;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Product\Entities\Product;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;
use Modules\Support\Money;

class Brand extends Model
{
    use Translatable, HasMedia, HasMetaData;

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
    protected $fillable = ['is_active'];

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
    public $translatedAttributes = ['name', 'presentation', 'slug'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

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

    /**
     * Get public url for the brand.
     *
     * @return string
     */
    public function url()
    {
        return route('brands.products.index', $this->slug);
    }

    public function getUrls()
    {
        $routeArray = [];
        foreach (supported_locales() as $locale => $language) {
            $slugTranslated = $this->getSlugTranslated($this, BrandTranslation::class, $locale);
            $routeArray[$locale] = trans('brand::routes.brands', [], $locale).'/'.$slugTranslated->slug.'/'.trans('brand::routes.products', [], $locale);
        }
        return $routeArray;
    }

    /**
     * Find a specific brand by the given slug.
     *
     * @param string $slug
     * @return self
     */
    public static function findBySlug($slug)
    {
        return self::select('brands.*', 'brand_translations.slug', 'brand_translations.name', 'brand_translations.presentation')->join('brand_translations', 'brand_translations.brand_id', '=', 'brands.id')
            ->where('brand_translations.slug', '=', $slug)
            ->firstOrNew([]);
    }

    /**
     * Get brand list.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function list()
    {
        return Cache::tags('brands')->rememberForever(md5('brands.list:' . locale()), function () {
            return self::all()->sortBy('name')->pluck('name', 'id');
        });
    }

    /**
     * Get the brand's logo.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getLogoAttribute()
    {
        return $this->files->where('pivot.zone', 'logo')->first() ?: new File;
    }

    /**
     * Get the brand's banner.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBannerAttribute()
    {
        return $this->files->where('pivot.zone', 'banner')->first() ?: new File;
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get related products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new BrandTable($this->newQuery()->withoutGlobalScope('active'));
    }
}
