<?php

namespace Domain\Catalog\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Domain\Catalog\Domain\Model\Book;
use Domain\Catalog\Domain\Model\Catalog;

class CatalogContext implements Context
{
    private $catalog;

    /**
     * @Given a catalog
     */
    public function aCatalog()
    {
        $this->catalog = new Catalog();
    }

    /**
     * @When I add the book :name from :author with a price of :price € and a quantity of :quantity
     */
    public function iAddTheBookFromWithAPriceOfEurAndAQuantityOf($name, $author, $price, $quantity)
    {
        $this->book = new Book(
            $name,
            $author,
            $price,
            $quantity
        );

        $this->catalog->addBook($this->book);
    }

    /**
     * @Then The book should be in the catalog
     */
    public function theBookShouldBeInTheCatalog()
    {
       if(!$this->catalog->contains($this->book)) {
           throw new \Exception('The catalog does not contain the book');
       }
    }

}