<?php

interface Borrowable 
{
    public function borrowItem(): string;
    public function returnItem(): string;
}