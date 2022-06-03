<?php

namespace Modules\Support\Eloquent;

use Astrotomic\Translatable\Translatable as AstrotomicTranslatable;

trait Translatable
{
    use AstrotomicTranslatable;

    /**
     * Save the model to the database.
     *
     * @param array $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (parent::save($options)) {
            return $this->saveTranslations();
        }

        return false;
    }

    /**
     * This scope filters results by checking the translation fields.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $key
     * @param array $values
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeWhereTranslationIn($query, $key, array $values, $locale = null)
    {
        return $query->whereHas('translations', function ($query) use ($key, $values, $locale) {
            $query->whereIn($key, $values)
                ->when(!is_null($locale), function ($query) use ($locale) {
                    $query->where('locale', $locale);
                });
        });
    }


    /**
     * @param $entity Model
     * @param $entity_translation string
     * @param $locale string
     * @return mixed
     */
    public function getSlugTranslated(Model $entity, string $entity_translation, string $locale)
    {
        /**
         * @param $model Model
         */
        $model = app($entity_translation);
        $column = str_replace("translations", "id", $model->getTable());
        /**
         * id pour sho product
         * $column pour le reste.
         */
        if (in_array($entity->getTable(), ['products', 'pages', 'categories', 'brands'])) {
            $columnVal = 'id';
        } else {
            $columnVal = $column;
        }
        return $model::whereRaw("locale = '{$locale}' AND {$column}={$entity->{$columnVal}}")->firstOr(function () use ($entity, $model, $column, $columnVal) {
            return $model::whereRaw("locale = '" . setting('default_locale') . "' AND {$column}={$entity->{$columnVal}}")->first();
        });
    }
}
