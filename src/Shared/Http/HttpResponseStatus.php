<?php

declare(strict_types=1);

namespace App\Shared\Http;

use Symfony\Component\HttpFoundation\Response;

enum HttpResponseStatus
{
    case OK;
    case BAD_REQUEST;
    case UNPROCESSABLE_ENTITY;
    case INTERNAL_SERVER_ERROR;

    public static function match(HttpResponseStatus $status): int
    {
        return match($status) {
            HttpResponseStatus::OK => Response::HTTP_OK,
            HttpResponseStatus::BAD_REQUEST => Response::HTTP_BAD_REQUEST,
            HttpResponseStatus::UNPROCESSABLE_ENTITY => Response::HTTP_UNPROCESSABLE_ENTITY,
            HttpResponseStatus::INTERNAL_SERVER_ERROR => Response::HTTP_INTERNAL_SERVER_ERROR,
        };
    }
}
