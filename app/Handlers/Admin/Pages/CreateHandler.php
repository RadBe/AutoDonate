<?php


namespace App\Handlers\Admin\Pages;


use App\DataObjects\Page\SaveDataObject;
use App\Entity\Page;
use App\Repository\Page\PageRepository;

class CreateHandler
{
    private $pageRepository;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function handle(SaveDataObject $do): void
    {
        $this->pageRepository->create(new Page(
            $do->getSlug(),
            $do->getTitle(),
            $do->getContent()
        ));
    }
}