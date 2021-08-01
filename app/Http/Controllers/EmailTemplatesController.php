<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EmailTemplateCreateRequest;
use App\Http\Requests\EmailTemplateUpdateRequest;
use App\Repositories\EmailTemplateRepository;
use App\Validators\EmailTemplateValidator;

/**
 * Class EmailTemplatesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EmailTemplatesController extends Controller
{
    /**
     * @var EmailTemplateRepository
     */
    protected $repository;

    /**
     * @var EmailTemplateValidator
     */
    protected $validator;

    /**
     * EmailTemplatesController constructor.
     *
     * @param EmailTemplateRepository $repository
     * @param EmailTemplateValidator $validator
     */
    public function __construct(EmailTemplateRepository $repository, EmailTemplateValidator $validator)
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
        $emailTemplates = $this->repository->all();

        return response()->json([
            'data' => $emailTemplates,
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
    public function store(Request $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $emailTemplate = $this->repository->create($request->all());
            $response = [
                'message' => 'Email Template created.',
                'data'    => $emailTemplate->toArray(),
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
