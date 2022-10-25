<?php

declare(strict_types=1);

namespace App\Shared\Translation;

enum TranslationDomain
{
    case TRANSLATIONS;

    public static function match(TranslationDomain $domain): string
    {
        return match($domain) {
            TranslationDomain::TRANSLATIONS => 'translations',
        };
    }
}
