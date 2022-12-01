<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;
use App\Models\ItemGroup;
use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class Lead
 *
 * @version April 20, 2020, 12:43 pm UTC
 * @property int $id
 * @property int $status_id
 * @property int $source_id
 * @property int $lead_drop_id
 * @property int|null $assign_to
 * @property string $name
 * @property string|null $position
 * @property string|null $email
 * @property int|null $estimate_budget
 * @property string|null $website
 * @property string|null $phone
 * @property string|null $company
 * @property string|null $description
 * @property int|null $default_language
 * @property int|null $public
 * @property int|null $contacted_today
 * @property string|null $date_contacted
 * @property string|null $country
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\Address $address
 * @property-read \App\Models\LeadSource $leadSource
 * @property-read \App\Models\LeadDrop $leadDrop
 * @property-read \App\Models\LeadStatus $leadStatus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereAssignTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereContactedToday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDateContacted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDefaultLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereWebsite($value)
 *  * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereEstimateBudget($value)
 * @mixin \Eloquent
 * @property-read \App\Models\User|null $assignedTo
 * @property string $company_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCompanyName($value)
 * @property int $lead_convert_customer
 * @property string|null $lead_convert_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereLeadConvertCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereLeadConvertDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Lead whereCountry($value)
 */
class Kas extends Model
{
    public $table = 'kas';
    public $timestamps = false;
    
    public $fillable = [
        'id',
        'nama_transaksi',
        'tgl_transaksi',
        'uang_keluar',
        'foto',
    ];

    const LANGUAGES = [
        'en' => 'English',
        'es' => 'Spanish',
        'fr' => 'French',
        'de' => 'German',
        'ru' => 'Russian',
        'pt' => 'Portuguese',
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'tr' => 'Turkish',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
    protected $primaryKey = 'id';
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_transaksi'    => 'required',
        'tgl_transaksi'          => 'required',
    ];


}
