<?php

namespace App\Entity\Enum;

enum SourceTypeEnum : string
{
    case EXTERNAL_API = 'External API';
    case RSS_FEED = 'RSS Feed';
    case LOCAL_FILE = 'Local file';
}
