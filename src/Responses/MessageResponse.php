<?php

declare(strict_types=1);

namespace Treblle\ApiResponses\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;
use Treblle\ApiResponses\Factories\HeaderFactory;

final readonly class MessageResponse implements Responsable
{
    /**
     * @param string $data
     * @param Status $status
     */
    public function __construct(
        private array $data,
        private string $message,
        private Status $status = Status::OK,
    ) {}

    /**
     * @param $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            message:$this->message,
            data:$this->data,
            status: $this->status->value,
            headers: HeaderFactory::default(),
        );
    }
}
