<?php

require_once 'LibraryItem.php';
require_once 'Interfaces/Borrowable.php';

class Book extends LibraryItem implements Borrowable
{
    private string $isbn;
    public int $pages;
    private bool $isBorrowed = false;

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

    private function validateIsbn(string $isbn): bool
    {
        return preg_match('/^\d{13}$/', $isbn);
    }

    public function borrowItem(): string
    {
        if ($this->isBorrowed) {
            return 'This item is already borrowed.';
        }
        $this->isBorrowed = true;
        return "You have borrowed: {$this->title}.";
    }

    public function returnItem(): string
    {
        if (!$this->isBorrowed) {
            return 'This item was not borrowed.';
        }
        $this->isBorrowed = false;
        return "You have returned: {$this->title}.";
    }

    public function getDetails(): string
    {
        return "Book: {$this->title} by {$this->author} ({$this->publicationYear}) - ISBN: {$this->isbn}";
    }
}