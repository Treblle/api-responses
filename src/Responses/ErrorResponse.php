<?php

declare(strict_types=1);

namespace Treblle\ApiResponses\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JustSteveKing\Tools\Http\Enums\Status;
use Treblle\ApiResponses\Data\ApiError;
use Treblle\ApiResponses\Factories\HeaderFactory;

final readonly class ErrorResponse implements Responsable
{
    /**
     * @param ApiError $data
     * @param Status $status
     */
    public function __construct(
        private ApiError  $data,
        private Status $status = Status::INTERNAL_SERVER_ERROR,
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data->toArray(),
            status: $this->status->value,
            headers: HeaderFactory::error(),
        );
    }
}
