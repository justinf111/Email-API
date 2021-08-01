<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\EmailTemplateRepository;
use App\Entities\EmailTemplate;
use App\Validators\EmailTemplateValidator;

/**
 * Class EmailTemplateRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailTemplateRepositoryEloquent extends BaseRepository implements EmailTemplateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailTemplate::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
