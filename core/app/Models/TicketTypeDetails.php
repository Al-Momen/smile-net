<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTypeDetails extends Model
{
    use HasFactory;
    protected $table = 'ticket_type_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'ticket_type_id',
        'user_id',
        'paid_price',
        'coupon',
        'payment_getway',
        'discount',
        'transaction_id',
        'sold',
    ];
    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'email_verified_at' => 'datetime',
    ];

    public function ticket_type(){
        return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
    public function user(){
        return $this->belongsTo(GeneralUser::class,'user_id','id');
    }


}
