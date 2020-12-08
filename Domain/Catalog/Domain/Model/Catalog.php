<?php

declare(strict_types=1);

namespace Domain\Catalog\Domain\Model;

class Catalog
{
    private $bookCollection;

    public function __construct() {
        $this->bookCollection = [];
    }

    public function addBook(Book $book)
    {
        $this->bookCollection[] = $book;
    }

    public function getBooks()
    {
        return $this->bookCollection;
    }

    public function contains(Book $book)
    {
        return in_array($book, $this->bookCollection);
    }
}