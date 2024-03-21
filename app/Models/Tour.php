<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory, HasUuids;

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

    protected $table = 'tours';

    protected $fillable = ['travelId', 'name', 'startDate', 'endDate', 'price'];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travelId', 'id');
    }

    /**
     * Get paginated tours by travel slug
     *
     * @param  array  $filters
     * @param  int  $paginate
     */
    public function getPaginatedToursByTravelSlug($filters, $paginate = 10): mixed
    {
        // Eager load travel related to the tours
        $tours = $this->whereHas('travel', function ($query) use ($filters) {
            return $query->where('slug', $filters['slug']);
        })->where(function ($query) use ($filters) {
            // Apply filters
            $query->when(isset($filters['priceFrom']) && isset($filters['priceTo']), function ($query) use ($filters) {
                $query->whereBetween('price', [($filters['priceFrom'] * 100), ($filters['priceTo'] * 100)]);
            });

            $query->when(isset($filters['dateFrom']), function ($query) use ($filters) {
                $query->where('startDate', '>=', $filters['dateFrom']);
            });

            $query->when(isset($filters['dateTo']), function ($query) use ($filters) {
                $query->where('endDate', '<=', $filters['dateTo']);
            });
        });

        if (! $tours) {
            return []; // Return empty array if travel with the provided slug is not found
        }

        return $tours->orderBy('price', isset($filters['sortByPrice']) ? $filters['sortByPrice'] : 'asc')
            ->orderBy('startDate', 'asc')
            ->paginate($paginate);
    }

    /**
     * Set the price attribute
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
}
