<?php

require_once 'LibraryItem.php';
require_once 'Interfaces/Borrowable.php';

class DVD extends LibraryItem implements Borrowable
{
    private int $duration;
    public string $format;
    private bool $isBorrowed = false;

    public function __construct(string $title, string $author, int $publicationYear, int $duration, string $format)
    {
        parent::__construct($title, $author, $publicationYear);
        if ($this->validateDuration($duration)) {
            $this->duration = $duration;
        } else {
            throw new Exception('Invalid duration.');
        }
        $this->format = $format;
    }

    public function __get(string $property): mixed
    {
        if ($property === 'duration') {
            return $this->duration;
        }
        throw new Exception("Property '$property' does not exist.");
    }

    public function __set(string $property, mixed $value)
    {
        if ($property === 'duration' && !$this->validateDuration($value)) {
            throw new Exception('Invalid duration.');
        }
        $this->$property = $value;
    }

    private function validateDuration(int $duration): bool
    {
        return $duration > 0;
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
        return "DVD: {$this->title} by {$this->author} ({$this->publicationYear}) - Duration: {$this->duration} mins, Format: {$this->format}";
    }
}