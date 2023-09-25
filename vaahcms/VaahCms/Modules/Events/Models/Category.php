<?php namespace VaahCms\Modules\Events\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WebReinvent\VaahCms\Entities\User;
use WebReinvent\VaahCms\Traits\CrudWithUuidObservantTrait;

class Category extends Model {

	  use SoftDeletes;
    use CrudWithUuidObservantTrait;

    //-------------------------------------------------
    protected $table = 'categorizables';
    //-------------------------------------------------
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    //-------------------------------------------------
    protected $fillable = [
        'uuid',
        'category_id'
    ];

    //-------------------------------------------------
    //-------------------------------------------------
    protected $appends  = [
    ];
    //-------------------------------------------------
    protected function serializeDate(\DateTimeInterface $date)
    {
        $date_time_format = config('settings.global.datetime_format');
        return $date->format($date_time_format);
    }
    //-------------------------------------------------
    public function categoryable()
    {
        return $this->morphTo();
    } //-------------------------------------------------
    public function getTaxonomy()
    {
        return $this->belongsTo(Taxonomy::class,'vh_taxonomy_type_id','','')->
            with('type');
    }
    //-------------------------------------------------

    public function createdByUser()
    {
        return $this->belongsTo(User::class,
            'created_by', 'id'
        )->select('id', 'uuid', 'first_name', 'last_name', 'email');
    }

    //-------------------------------------------------
    public function updatedByUser()
    {
        return $this->belongsTo(User::class,
            'updated_by', 'id'
        )->select('id', 'uuid', 'first_name', 'last_name', 'email');
    }

    //-------------------------------------------------
    public function deletedByUser()
    {
        return $this->belongsTo(User::class,
            'deleted_by', 'id'
        )->select('id', 'uuid', 'first_name', 'last_name', 'email');
    }
    //-------------------------------------------------
    public function getTableColumns()
        {
            return $this->getConnection()
                ->getSchemaBuilder()
                ->getColumnListing($this->getTable());
        }

        //-------------------------------------------------
        public function scopeExclude($query, $columns)
        {
            return $query->select(array_diff($this->getTableColumns(), $columns));
        }

        //-------------------------------------------------
        public function scopeBetweenDates($query, $from, $to)
        {

            if ($from) {
                $from = \Carbon::parse($from)
                    ->startOfDay()
                    ->toDateTimeString();
            }

            if ($to) {
                $to = \Carbon::parse($to)
                    ->endOfDay()
                    ->toDateTimeString();
            }

            $query->whereBetween('updated_at', [$from, $to]);
        }

    //-------------------------------------------------

}
