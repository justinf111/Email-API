<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailTemplate.
 *
 * @package namespace App\Entities;
 */
class EmailTemplate extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content'];

    public function emailLogs() {
        return $this->hasMany(EmailLog::class, 'email_template_id');
    }
}
