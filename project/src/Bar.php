<?php

declare(strict_types=1);

namespace App\Project;

use App\Library\Foo;

class Bar {
    public static function produceValue(): int
    {
        return Foo::produceValue();
    }
}