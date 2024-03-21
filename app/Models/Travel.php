<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
