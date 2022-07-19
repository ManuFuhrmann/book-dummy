<?php

namespace Manuel\Core\Services;

use http\Env\Request;
use Manuel\Core\Interfaces\IEntity;
use Manuel\Core\Repositories\InvoiceRepository;
use Manuel\Domain\EntityInvoice;

class ServiceInvoice
{
    private EntityInvoice $invoiceEntity;
    private InvoiceRepository $invoiceRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function cancelAction(
        int $invoiceId
    ): void {
        $this->invoiceRepository->getById($invoiceId);
    }
}