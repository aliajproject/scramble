<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

# ✅ 1. Əvvəlki sənədləşdirmə paketini sil (əgər mövcuddursa)
```
composer remove rakutentech/laravel-request-docs
```
# 🚀 2. Scramble paketini əlavə et
```
composer require dedoc/scramble --dev
```
# 🔀 3. Ana səhifəni API sənədinə yönləndir
```
Route::get('/', function () {
    return redirect('/docs/api');
});
```

# Codes
```
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
```

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
