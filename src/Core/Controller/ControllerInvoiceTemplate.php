<?php

namespace Manuel\Core\Controller;


use Manuel\Core\Interfaces\IRepository;
use Manuel\Core\Interfaces\IResponse;
use Manuel\Core\PrimaryKeyStandard;
use Manuel\Domain\ResponseHtml;

class ControllerInvoiceTemplate
{
    public function __construct(private IRepository $repository, private IResponse $response)
    {
        $this->repository = $repository;
    }

    public function getData(string $id): IResponse
    {
        $primKey = new PrimaryKeyStandard($id);
        $invoiceTemplate = $this->repository->getById($primKey);

        $sInvoiceTemplate = array();
        foreach($invoiceTemplate->asArray() as $key => $value) {
            $sInvoiceTemplate[] = array(
                'key' => $key,
                'value' => $value,
            );
        }

        $this->response->setData($sInvoiceTemplate);
        return $this->response;
    }

    /**
     * @param string $id
     * @return IResponse
     * @throws \Exception
     */
    public function setInactiveAction(string $id): IResponse
    {
        $invoiceTemplate = $this->repository->getById($id);
        if ($invoiceTemplate->setInactive()) {
            $this->repository->save($invoiceTemplate);
        } else {
            throw new \Exception('Could not inactivate InvoiceTemplate');
        }

        $sInvoiceTemplate = '';
        foreach($invoiceTemplate->asArray() as $key => $value) {
            $sInvoiceTemplate .= $key . ' = ' . $value . ';<br>';
        }

        return new ResponseHtml($sInvoiceTemplate);
    }
}