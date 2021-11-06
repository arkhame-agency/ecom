<?php

namespace Modules\Category\Entities;

use Illuminate\Support\Facades\Cache;
use Modules\Media\Eloquent\HasMedia;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;
use TypiCMS\NestableTrait;

class Category extends Model
{
    use Translatable, HasMedia, NestableTrait;

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
    protected $fillable = ['parent_id', 'position', 'is_searchable', 'is_active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['translations'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_searchable' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'slug'];

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
     * Find a specific category by the given slug.
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|Category
     */
    public static function findBySlug($slug)
    {
        return static::select('categories.*', 'category_translations.slug', 'category_translations.name')->with('files')
            ->join('category_translations', 'category_translations.category_id', '=', 'categories.id')
            ->where('category_translations.slug', '=', $slug)
            ->firstOrNew([]);
    }

    public function isRoot()
    {
        return $this->exists && is_null($this->parent_id);
    }

    public function url()
    {
        return route('categories.products.index', ['category' => $this->slug]);
    }

    public function getUrls()
    {
        $routeArray = [];
        foreach (supported_locales() as $locale => $language) {
            $slugTranslated = $this->getSlugTranslated($this, CategoryTranslation::class, $locale);
            $routeArray[$locale] = '/categories/'.$slugTranslated->slug.trans('category::routes.products', [], $locale);
        }
        return $routeArray;
    }

    public static function tree()
    {
        return Cache::tags('categories')
            ->rememberForever(md5('categories.tree:' . locale()), function () {
                return static::with('files')
                    ->orderByRaw('-position DESC')
                    ->get()
                    ->nest();
            });
    }

    public static function treeList()
    {
        return Cache::tags('categories')->rememberForever(md5('categories.tree_list:' . locale()), function () {
            return static::orderByRaw('-position DESC')
                ->get()
                ->nest()
                ->setIndent('¦–– ')
                ->listsFlattened('name');
        });
    }

    public static function searchable()
    {
        return Cache::tags('categories')
            ->rememberForever(md5('categories.searchable:' . locale()), function () {
                return static::where('is_searchable', true)
                    ->get()
                    ->map(function ($category) {
                        return [
                            'slug' => $category->slug,
                            'name' => $category->name,
                        ];
                    });
            });
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function getLogoAttribute()
    {
        return $this->files->where('pivot.zone', 'logo')->first() ?: new File;
    }

    public function getBannerAttribute()
    {
        return $this->files->where('pivot.zone', 'banner')->first() ?: new File;
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        if ($this->relationLoaded('files')) {
            $attributes += [
                'logo' => [
                    'id' => $this->logo->id,
                    'path' => $this->logo->path,
                    'exists' => $this->logo->exists,
                ],
                'banner' => [
                    'id' => $this->banner->id,
                    'path' => $this->banner->path,
                    'exists' => $this->banner->exists,
                ],
            ];
        }

        return $attributes;
    }
}
