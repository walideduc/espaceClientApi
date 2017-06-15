<?php

namespace spec\Veolia;

use Veolia\SearchService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SearchServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SearchService::class);
    }
}
