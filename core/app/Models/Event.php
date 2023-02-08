<?php

namespace App\Models;

use App\Models\EventPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'author_event_id',
        'category_id',
        'price_currency_id',
        'title',
        'description',
        'image',
        'tag',
        'status',
        'slug',
        "start_date",
        "total_seat",
        "available_seat",
        "remain_seat",
        "end_date",
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    // --------------relation category one to many--------------
    public function category()
    {
        return $this->belongsTo(AdminCategory::class);
    }
     // --------------relation user one to one--------------
    public function user()
    {
        return $this->belongsTo(GeneralUser::class,'author_event_id','id');
    }   

    public function admin(){
        return $this->belongsTo(Auth::class,'author_event_id','id');
    } 
   
    public function priceCurrency()
    {
        return $this->belongsTo(PriceCurrency::class, 'price_currency_id', 'id');
    }
     // --------------relation plan one to many--------------
    public function eventPlans()
    {
        return $this->hasMany(EventPlan::class,);
    }
}
