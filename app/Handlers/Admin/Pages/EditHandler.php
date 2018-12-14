<?php


namespace App\Handlers\Admin\Pages;


use App\DataObjects\Page\SaveDataObject;
use App\Entity\Page;
use App\Exceptions\Page\PageNotFoundException;
use App\Repository\Page\PageRepository;

class EditHandler
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

    public function handle(SaveDataObject $do, Page $page): void
    {
        $page->setTitle($do->getTitle())
            ->setContent($do->getContent());

        $this->pageRepository->update($page);
    }
}