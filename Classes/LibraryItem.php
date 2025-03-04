<?php

Class LibraryItem
{
    public string $title;
    public string $author;
    private int $publicationYear;
    private bool $isBorrowed;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        bool $isBorrowed = false
    )
    {
        $this->title = $title;
        $this->author = $author;
        if ($this->validateYear($publicationYear)) {
            $this->publicationYear = $publicationYear;
        } else {
            throw new Exception('Invalid publication year.');
        }

        $this->isBorrowed = $isBorrowed;
    }

    public function __get(string $property): mixed
    {
        if ($property === 'publicationYear') {
            return $this->publicationYear;
        }

        throw new Exception("Property '$property' does not exist.");
    }

    public function isBorrowed(): bool
    {
        return $this->isBorrowed;
    }

    public function __set(string $property, mixed $value)
    {
        if ($property === 'publicationYear' && !$this->validateYear($value)) {
            throw new Exception('Invalid publication year.');
        }
        $this->$property = $value;
    }

    protected function validateYear(int $year): bool
    {
        return $year > 0 && $year <= date('Y');
    }

    public function getDetails(): string
    {
        return "{$this->title} by {$this->author} ({$this->publicationYear})";
    }

    public function borrow(): string 
    {
        if ($this->isBorrowed) {
            return 'This item is already borrowed.';
        }
        $this->isBorrowed = false;
        return "You have borrowed: {$this->title}.";
    }

    public function returnItem(): string {
        if (!$this->isBorrowed) {
            return 'This item was not borrowed.';
        }
        $this->isBorrowed = false;
        return "You have returned: {$this->isBorrowed}.";
    }
}