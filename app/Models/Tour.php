<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
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

    protected $table = 'tours';

    protected $fillable = ['travelId', 'name', 'startDate', 'endDate', 'price'];

    public function travel()
    {
        return $this->belongsTo(Travel::class, 'travelId', 'id');
    }

    public function getPaginatedToursByTravelSlug($filters, $paginate = 10)
    {
        // Eager load travel related to the tours    
        $tours = $this->whereHas('travel', function($query) use ($filters) {
            return $query->where('slug', $filters['slug']);
        })->where(function ($query) use ($filters) {
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

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
}
