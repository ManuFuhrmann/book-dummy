<?php

namespace Manuel\Core\Services;

use http\Env\Request;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\Repositories\InvoiceRepository;
use Manuel\Domain\EntityInvoice;
use Manuel\Domain\EntityInvoiceTemplate;

class ServiceInvoiceTemplate
{
    private EntityInvoiceTemplate $invoiceTemplateEntity;
    private InvoiceTemplateRepository $invoiceTemplateRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceTemplateRepository = $invoiceRepository;
    }

    public function inactiveAction(
        int $invoiceId
    ): void {
        $this->invoiceTemplateRepository->getById();
    }
}