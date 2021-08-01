<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Recipient.
 *
 * @package namespace App\Entities;
 */
class Recipient extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email'];

    public function emailLogs() {
        return $this->belongsToMany(EmailLog::class, 'email_log_recipient', 'recipient_id', 'email_log_id');
    }
}
