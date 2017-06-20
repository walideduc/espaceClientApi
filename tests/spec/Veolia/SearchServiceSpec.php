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

    function it_returns_clinet_user_serach_result()
    {
        $query = "orange";
        $this->clientUserSearch($query)->shouldHaveKey('data');
    }
}
