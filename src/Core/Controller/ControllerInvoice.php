<?php

namespace Manuel\Core\Controller;

use Manuel\Core\Interfaces\IRepository;
use Manuel\Core\Services\InvoiceService;
use Manuel\Domain\ResponseHtml;
use Manuel\Infrastructure\RepositorySqlInvoiceTemplate;
use Manuel\Domain\Request;
use ResponseInterface;

class ControllerInvoice
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getData(string $id): IResponse
    {
        $invoiceTemplate = $this->repository->getById($id);

        $sInvoiceTemplate = '';
        foreach($invoiceTemplate->asArray() as $key => $value) {
            $sInvoiceTemplate .= $key . ' = ' . $value . ';<br>';
        }

        return new ResponseHtml($sInvoiceTemplate);
    }

    public function cancelInvoiceAction(Request $request): ResponseInterface
    {
        $invoiceEntity = new RepositorySqlInvoiceTemplate();
        $invoiceService = new InvoiceService();

        return new ResponseHtml('ResponseHtml');
    }
}