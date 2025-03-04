<?php

require_once 'LibraryItem.php';

Class DVD extends LibraryItem
{
    private int $duration;
    public string $format;

    public function __construct(
        string $title,
        string $author,
        int $publicationYear,
        int $duration,
        string $format
    )
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

    public function getDetails(): string
    {
        return 'DVD: ' . parent::getDetails() . " - Duration: {$this->duration} mins, Format: {$this->format}";
    }
}