<?php

namespace App\Models;

use App\Models\TicketType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventPlan extends Model
{
    use HasFactory;
    protected $table = 'event_plans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'author_event_id',
        'event_id',
        'ticket_type_id',
        'seat',
        'price',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
    public function eventPlanTransaction()
    {
        return $this->hasMany(EventPlanTransaction::class,'event_plan_id','id');
    }

}
