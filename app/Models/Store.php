<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reserves()
    {
        return $this->hasMany(Reserve::class);
    }

    public function getTotalScoreAttribute()
    {
        $reviews = $this->reviews()->get();

        if($reviews->first()) {
            $count = $reviews->count();
            $total = 0;
            foreach($reviews as $review) {
                $total += $review->score;
            }
            $ave = round($total / $count, 1);
        } else {
            $count = 0;
            $ave = 0;
        }

        $total_score = [
            'count' => $count,
            'ave' => $ave,
        ];

        return $total_score;
    }
}
