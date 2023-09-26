<?php namespace VaahCms\Modules\Events\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Factory;
use WebReinvent\VaahCms\Models\TaxonomyBase;
use WebReinvent\VaahCms\Traits\CrudWithUuidObservantTrait;
use WebReinvent\VaahCms\Models\User;
use WebReinvent\VaahCms\Libraries\VaahSeeder;

class Taxonomy extends TaxonomyBase
{

protected function serializeDate(DateTimeInterface $date)
{
    $date_time_format = config('settings.global.datetime_format');
    return $date->format($date_time_format);
}

}
