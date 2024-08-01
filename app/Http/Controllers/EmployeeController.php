<?php

namespace App\Http\Controllers;


use App\Exceptions\NotFoundException;
use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Info;
use OpenApi\Attributes\MediaType;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\RequestBody;
use OpenApi\Attributes\Response;
use OpenApi\Attributes\Schema;

#[Info(
    version: '3.0.0',
    description: 'Get available cars API',
    title: 'Get available cars API',
)]

class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeService $employee
    ) {}

    /**
     * @throws NotFoundException
     */
    #[Get(
        path: '/api/getAutoList/{id}',
        description: 'method of obtaining a list of cars available
            to the current user for a planned time with the ability to
            filter by car model, by comfort category',
        tags: ['GET']
    )]
    #[RequestBody(
        content: new MediaType(JsonResponse::class,
            schema: new Schema(
                properties: [
                    new Property(
                        property: 'startDate',
                        type: 'string',
                        example: '2024-08-01'
                    ),
                    new Property(
                        property: 'startTime',
                        type: 'string',
                        example: '10:00'
                    ),
                    new Property(
                        property: 'endTime',
                        type: 'string',
                        example: '12:00'
                    ),
                    new Property(
                        property: 'model',
                        type: 'string',
                        example: 'zil',
                        nullable: true

                    ),
                    new Property(
                        property: 'comfortType',
                        type: 'string',
                        example: null,
                        nullable: true
                    ),
                ]
            )),
    )]
    #[Response(
        response: 200,
        description: 'Returns available cars',
        content: new MediaType(JsonResponse::class,
            schema: new Schema(
                properties: [
                    new Property(
                        property: 'availableCarId №1',
                        type: 'integer',
                        example: 1
                        ),
                    new Property(
                        property: 'availableCarId №2',
                        type: 'integer',
                        example: 3
                    )
                ]
            )
        )
    )]
    #[Response(
        response: 204,
        description: 'No content',
        content: new MediaType(JsonResponse::class)
    )]
    #[Response(
        response: 404,
        description: 'Not found',
        content: new MediaType(JsonResponse::class)
    )]
    public function getAvailableCars(EmployeeRequest $request, int $id): JsonResponse
    {
        try {
            $data = $this->employee->getAutoList($request, $id);
        } catch (NotFoundException $e) {
            throw new NotFoundException($e->getMessage(), $e->getCode());
        }
        if (empty($data)) {
            return response()->json([], 204);
        }
        $response = [];
        $i = 0;
        foreach ($data as $key) {
            $i++;
            $response["availableCarId №".$i] = $key;
        }
        return response()->json($response);
    }
}
