<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Services\Students\StudentsService;

use App\Http\Requests\Students\ShowRequest;
use App\Http\Requests\Students\IndexRequest;
use App\Http\Requests\Students\StoreRequest;
use App\Http\Requests\Students\UpdateRequest;
use App\Http\Requests\Students\DestroyRequest;

use App\Http\Resources\Students\StudentsResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class StudentsController extends Controller
{
    public function __construct(public StudentsService $service) {}

    /**
     * Get list of students
     *
     * @param IndexRequest $request
     * @return JsonResponse
     * @apiResourceCollection App\Http\Resources\Students\StudentsResource
     * @apiResourceModel App\Models\User
     */
    public function index(IndexRequest $request): JsonResponse
    {
        try {
            $student = $this->service->index($request);
            return response()->json([
                'message' => __('DataFetchedSuccessfully'),
                'data' => $student
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => __('FailureProcess'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store new student
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @apiResource App\Http\Resources\Students\StudentsResource
     * @apiResourceModel App\Models\User
     */
    public function store(StoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $student = $this->service->store($request);
            DB::commit();
            return response()->json([
                'message' => __('DataStoredSuccessfully'),
                'data' => new StudentsResource($student),
            ], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => __('FailureProcess'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show student details
     *
     * @param ShowRequest $request
     * @return JsonResponse
     * @apiResource App\Http\Resources\Students\StudentsResource
     * @apiResourceModel App\Models\User
     */
    public function show(ShowRequest $request): JsonResponse
    {
        try {
            $student = $this->service->show($request);
            return response()->json([
                'message' => __('DataFetchedSuccessfully'),
                'data' => new StudentsResource($student)
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => __('FailureProcess'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update student
     *
     * @param UpdateRequest $request
     * @return JsonResponse
     * @apiResource App\Http\Resources\Students\StudentsResource
     * @apiResourceModel App\Models\User
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $student = $this->service->update($request);
            DB::commit();
            return response()->json([
                'message' => __('DataUpdatedSuccessfully'),
                'data' => new StudentsResource($student)
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => __('FailureProcess'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete student
     *
     * @param DestroyRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $student = $this->service->destroy($request);
            DB::commit();
            return response()->json([
                'message' => __('DataDeletedSuccessfully'),
                'data' => $student,
            ], Response::HTTP_OK);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => __('FailureProcess'),
                'data' => [],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
