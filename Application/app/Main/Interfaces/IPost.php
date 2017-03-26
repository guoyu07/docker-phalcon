<?php

namespace App\Main\Interfaces;


class IPost
{
    /**
     * @var $title string
     */
    public $title;
    /**
     * @var $body string
     */
    public $body;
    /**
     * @var $author IUser
     */
    public $author;
}