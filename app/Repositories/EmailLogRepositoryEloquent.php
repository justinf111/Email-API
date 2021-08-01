<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmailLogRepository;
use App\Entities\EmailLog;

/**
 * Class EmailLogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailLogRepositoryEloquent extends BaseRepository implements EmailLogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailLog::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
