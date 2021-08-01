<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailLog.
 *
 * @package namespace App\Entities;
 */
class EmailLog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject', 'email_template_id'];

    public function emailTemplate() {
        return $this->belongsTo(
            EmailTemplate::class,
            'email_template_id'
        );
    }

    public function recipients() {
        return $this->belongsToMany(
                Recipient::class,
                'email_log_recipient',
                'email_log_id',
                'recipient_id'
            )
            ->withPivot('status');
    }
}
