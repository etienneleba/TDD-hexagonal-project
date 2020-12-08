<?php

namespace Specs\Domain\Catalog\Domain\Model;

use Domain\Catalog\Domain\Model\Book;
use PhpSpec\ObjectBehavior;

class BookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Book::class);
    }
}
