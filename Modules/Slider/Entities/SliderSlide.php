<?php

namespace Modules\Slider\Entities;

use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Support\Eloquent\Translatable;

class SliderSlide extends Model
{
    use Translatable;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations', 'file'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['options', 'open_in_new_window', 'position', 'enable', 'start_date', 'end_date'];

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
        'open_in_new_window' => 'boolean',
        'enable' => 'boolean'
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'file_id',
        'caption_1',
        'caption_2',
        'direction',
        'call_to_action_text',
        'call_to_action_url',
    ];

    public function isAlignedLeft()
    {
        return $this->direction === 'left';
    }

    public function isAlignedRight()
    {
        return $this->direction === 'right';
    }

    public function file()
    {
        return $this->belongsTo(File::class)->withDefault();
    }

    private function hasStartDate()
    {
        return !is_null($this->start_date);
    }

    private function hasEndDate()
    {
        return !is_null($this->end_date);
    }

    private function startDateIsValid()
    {
        return today() >= $this->start_date;
    }

    private function endDateIsValid()
    {
        return today() <= $this->end_date;
    }

    public function hasDateToShow()
    {

        if ($this->hasStartDate() && $this->hasEndDate()) {
            return ($this->startDateIsValid() && $this->endDateIsValid());
        }

        return true;
    }
}
