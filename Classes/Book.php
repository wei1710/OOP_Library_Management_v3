<?php

require_once 'LibraryItem.php';

Class Book extends LibraryItem
{
    private string $isbn;
    public int $pages;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        string $isbn,
        int $pages
    )
    {
        parent::__construct($title, $author, $publicationYear);
        if ($this->validateIsbn($isbn)) {
            $this->isbn = $isbn;
        } else {
            throw new Exception('Invalid ISBN format.');
        }
        $this->pages = $pages;
    }

    public function __get(string $property): mixed
    {
        if ($property === 'isbn') {
            return $this->isbn;
        }

        throw new Exception("Property '$property' does not exist.");
    }

    public function __set(string $property, mixed $value)
    {
        if ($property === 'isbn' && !$this->validateIsbn($value)) {
            throw new Exception('Invalid ISBN format.');
        }
        $this->$property = $value;
    }

    private function validateIsbn(string $isbn): bool
    {
        return preg_match('/^\d{13}$/', $isbn);
    }

    public function getDetails(): string
    {
        return 'Book: ' . parent::getDetails() . " - ISBN: {$this->isbn}";
    }
}