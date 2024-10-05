<?php

namespace AliAwwad\FineSeo\Tests;

use AliAwwad\FineSeo\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
