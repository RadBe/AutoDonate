<?php


namespace App\Handlers\Admin\Pages;


use App\Repository\Page\PageRepository;

class ListHandler
{
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function handle(): array
    {
        return $this->pageRepository->getAll();
    }
}