<?php

namespace App\Services\Students;

use App\Http\Requests\Students\IndexRequest;
use App\Repositories\Students\StudentsRepository;

class StudentsService
{
    public function __construct(public StudentsRepository $repository) {}

    public function index(IndexRequest $request)
    {
        return $this->repository->index($request->search, $request->input('page', 1));
    }

    public function store($request)
    {
        return $this->repository->store($request);
    }

    public function show($request)
    {
        return $this->repository->show($request);
    }

    public function update($request)
    {
        return $this->repository->update($request);
    }

    public function destroy($request)
    {
        return $this->repository->destroy($request);
    }
}
