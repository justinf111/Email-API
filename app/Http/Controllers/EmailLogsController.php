<?php

namespace App\Http\Controllers;

use App\Actions\AddRecipientsToEmailLog;
use App\Entities\Recipient;
use App\Repositories\RecipientRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\EmailLogRepository;
use App\Validators\EmailLogValidator;

/**
 * Class EmailTemplatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EmailLogsController extends Controller
{
    /**
     * @var EmailLogRepository
     */
    protected $repository;

    /**
     * @var EmailLogValidator
     */
    protected $validator;

    /**
     * EmailTemplatesController constructor.
     *
     * @param EmailLogRepository $repository
     * @param EmailLogValidator $validator
     */
    public function __construct(EmailLogRepository $repository, EmailLogValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $emailLogs = $this->repository->all();

        return response()->json([
            'data' => $emailLogs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(AddRecipientsToEmailLog $addRecipientsToEmailLog, RecipientRepository $recipientRepository, Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail();
            $emailLog = $this->repository->create($request->only('subject', 'email_template_id'));
            $emailLog = $addRecipientsToEmailLog->execute($emailLog, collect($request->get('recipients')));
            $response = [
                'message' => 'Email Log created.',
                'data'    => $emailLog->toArray(),
            ];
            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }
}
