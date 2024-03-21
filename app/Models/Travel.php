<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class Travel
 *
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property int $numberOfDays
 * @property array $moods
 * @property int $moods->nature
 * @property int $moods->relax
 * @property int $moods->history
 * @property int $moods->culture
 * @property int $moods->party
 */
class Travel extends Model
{
    use HasUuids;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'createdAt';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updatedAt';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    protected $table = 'travels';

    protected $fillable = ['isPublic', 'slug', 'name', 'description', 'numberOfDays', 'moods'];

    protected $casts = [
        'moods' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($travel) {
            $travel->slug = Str::slug($travel->name);
        });
    }

    public function tours()
    {
        return $this->hasMany(Tour::class, 'travelId');
    }

    /**
     * Get paginated tours by travel slug
     *
     * @param  array  $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedToursBySlug($filters, $paginate = 10)
    {
        // Eager load tours related to the travel
        $travelId = $this->where('slug', $filters['slug'])->pluck('id')->first();

        $tours = DB::table('tours')->where('travelId', $travelId)->where(function ($query) use ($filters) {
            // Apply filters
            if (isset($filters['priceFrom']) && isset($filters['priceTo'])) {
                $query->whereBetween('price', [($filters['priceFrom'] * 100), ($filters['priceTo'] * 100)]); // Convert to database format
            }

            if (isset($filters['dateFrom'])) {
                $query->where('startDate', '>=', $filters['dateFrom']);
            }

            if (isset($filters['dateTo'])) {
                $query->where('endDate', '<=', $filters['dateTo']);
            }
        });

        if (! $tours) {
            return []; // Return empty array if travel with the provided slug is not found
        }

        return $tours->orderBy('price', isset($filters['sortByPrice']) ? $filters['sortByPrice'] : 'asc')
            ->orderBy('startDate', 'asc')
            ->paginate($paginate);
    }
}
