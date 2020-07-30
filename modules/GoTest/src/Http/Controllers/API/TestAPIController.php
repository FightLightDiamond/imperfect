<?php

namespace GoTest\Http\Controllers\API;


use App\Http\Controllers\Controller;
use GoTest\Http\Requests\API\TestCreateRequest;
use GoTest\Http\Requests\API\TestUpdateRequest;
use GoTest\Http\Resources\API\TestResource;
use GoTest\Http\Resources\API\TestResourceCollection;
use GoTest\Http\Services\API\TestService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TestAPIController extends Controller
{
    private $service;

    public function __construct(TestService $service)
    {
        $this->service = $service;
    }

    /**
     * Paginate
     * @group Test
     * @authenticated
     *
     * @queryParam id required The fund id. Example: 1
     *
     * @response {
     * "data": [
     *   {
     *    "id": 10,
     *    "created_at": "2019-09-04 10:43:47",
     *    "updated_at": "2019-09-04 10:43:47"
     *   },
     *   {
     *    "id": 9,
     *    "created_at": "2019-09-04 08:56:43",
     *    "updated_at": "2019-09-04 08:56:43"
     *   }
     *  ],
     *  "links": {
     *     "first": "{url}?page=1",
     *     "last": "{url}?page=1",
     *     "prev": null,
     *     "next": null
     *  },
     *  "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "{url}",
     *     "per_page": 10,
     *     "to": 2,
     *     "total": 2
     *   }
     * }
     */
    public function index(Request $request)
    {
        try {
            $input = $request->all();
            $data = $this->service->index($input);

            return new TestResourceCollection($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Create
     * @group Test
     * @authenticated
     *
     * @bodyParam is_active int required The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function store(TestCreateRequest $request)
    {
        try {
            $input = $request->all();
            $test = $this->service->store($input);

            return response()->json(new TestResource($test));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Show
     * @group Test
     * @authenticated
     *
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function show($id)
    {
        try {
            $test = $this->service->show($id);

            return response()->json(new TestResource($test));
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Update
     * @group Test
     * @authenticated
     *
     * @bodyParam is_active int optional The is active. Example: 1
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function update(TestUpdateRequest $request, $id)
    {
        $input = $request->all();
        try {
            $data = $this->service->update($input, $id);

            return new TestResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }

	/**
     * Destroy
     * @group Test
     * @authenticated
     *
     * @response {
     *  "is_active": 0,
     *  "updated_at": "2019-09-05 02:34:34",
     *  "created_at": "2019-09-05 02:34:34",
     *  "id": 11
     * }
     *
     */
    public function destroy($id)
    {
        try {
            $data = $this->service->destroy($id);

            return new TestResource($data);
        } catch (\Exception $exception) {
            logger($exception);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
