<?php


namespace App\Handlers\Admin\Pages;


use App\Entity\Page;
use App\Exceptions\Page\PageNotFoundException;
use App\Repository\Page\PageRepository;

class DeleteHandler
{
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function getPage(string $slug): Page
    {
        $page = $this->pageRepository->find($slug);
        if(is_null($page)) {
            throw PageNotFoundException::bySlug($slug);
        }

        return $page;
    }

    public function handle(Page $page): void
    {
        $this->pageRepository->delete($page);
    }
}