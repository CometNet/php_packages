<?php


namespace Huixing\UCenter\Models;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['user_id', 'name', 'type', 'stat', 'before_money', 'money', 'description', 'order_id', 'account'];

}