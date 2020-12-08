<?php

namespace Specs\Domain\Catalog\Domain\Model;

use Domain\Catalog\Domain\Model\Book;
use Domain\Catalog\Domain\Model\Catalog;
use PhpSpec\ObjectBehavior;

class CatalogSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Catalog::class);
    }

    function it_should_add_a_book(Book $book) {
        $this->addBook($book);
    }

    function it_should_tell_if_it_contains_books(Book $book) {
        $this->it_should_add_a_book($book);

        $this->contains($book)->shouldReturn(true);

    }
}
