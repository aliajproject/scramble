<?php

namespace App\Repositories\Students;

use App\Models\User;
use App\Http\Requests\Students\StoreRequest;

class StudentsRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index($search = null, $page = 1)
    {
        $superadmin = $this->model
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30, ['*'], 'page', $page);

        return [
            'current_page' => $superadmin->currentPage(),
            'data' => $superadmin->items(),
            'from' => $superadmin->firstItem(),
            'last_page' => $superadmin->lastPage(),
            'per_page' => $superadmin->perPage(),
            'to' => $superadmin->lastItem(),
            'total' => $superadmin->total(),
        ];
    }

    public function store(StoreRequest $request)
    {
        return $request->storeUser(); // qaytardığı result obyekt olmalıdır
    }

    public function show($request)
    {
        return $this->model->where('uuid', $request->uuid)->first();
    }

    public function update($request)
    {
        $user = $this->model->where('uuid', $request->uuid)->first();
        if ($user) {
            $user->update($request->validated());
        }
        return $user; // model obyekti qaytarılır (null ola bilər)
    }

    public function destroy($request)
    {
        $user = $this->model->where('uuid', $request->uuid)->first();
        if ($user) {
            $user->delete();
            return $user; // ❗ qaytarılan `true` yox, silinmiş model obyekti olsun
        }
        return null;
    }
}
