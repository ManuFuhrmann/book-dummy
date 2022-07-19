<?php

namespace Manuel\Domain;

use Manuel\Core\Entity;

class EntityInvoice extends Entity
{
    public int $InvoiceId = 0;
    public string|null $InvoiceDate = null;
    public string|null $InvoiceNumber = null;
    public string $RecipientName = '';
    public string $FileName = '';
    public string|null $InvoiceMonth = null;
    public string|null $InvoiceYear = null;
    public int $InvoiceDataRecipientId = 0;
    public string $DateSent = '';
    public int $Storniert = 0;
    public string $StorniertDate = '';
    public int|null $ParentInvoice = null;
    public string $SendBy = 'E-Mail';
    public string $RecipientEMail = '';
    public string $RecipientEMailCC = '';
    public string $RecipientEMailBCC = '';
    public string $RecipientEMailSubject = '';
    public string $RecipientEMailBody = '';
    public string $DateReminder1Sent = '';
    public string $Reminder1Text = '';
    public string $DateReminder2Sent = '';
    public string $Reminder2Text = '';
    public string $DatePaid = '';
    public string $Kundennummer = '';
    public float $InvoiceNetSum = 0.00;
    public float $InvoiceSum = 0.00;
    public string $InvoiceCurrency = 'EUR';
    public string $RechnungsAdresse1 = '';
    public string $RechnungsAdresse2 = '';
    public string $Rechnungsstrasse = '';
    public string $RechnungsPLZStadt = '';
    public string $RechnungsLand = '';
    public string $InfotextOben = '';
    public string $InfotextUnten = '';
    public string $PriceScaleInfos = '';
    public string $Language = 'de';

    public $details = array();

    public function asArray(): array
    {
        return array(
            'InvoiceId' => $this->InvoiceId,
            'InvoiceDate' => $this->InvoiceDate,
            'InvoiceNumber' => $this->InvoiceNumber,
            'RecipientName' => $this->RecipientName,
            'FileName' => $this->FileName,
            'InvoiceMonth' => $this->InvoiceMonth,
            'InvoiceYear' => $this->InvoiceYear,
            'InvoiceDataRecipientId' => $this->InvoiceDataRecipientId,
            'DateSent' => $this->DateSent,
            'Storniert' => $this->Storniert,
            'StorniertDate' => $this->StorniertDate,
            'ParentInvoice' => $this->ParentInvoice,
            'SendBy' => $this->SendBy,
            'RecipientEMail' => $this->RecipientEMail,
            'RecipientEMailCC' => $this->RecipientEMailCC,
            'RecipientEMailBCC' => $this->RecipientEMailBCC,
            'RecipientEMailSubject' => $this->RecipientEMailSubject,
            'RecipientEMailBody' => $this->RecipientEMailBody,
            'DateReminder1Sent' => $this->DateReminder1Sent,
            'Reminder1Text' => $this->Reminder1Text,
            'DateReminder2Sent' => $this->DateReminder2Sent,
            'Reminder2Text' => $this->Reminder2Text,
            'DatePaid' => $this->DatePaid,
            'Kundennummer' => $this->Kundennummer,
            'InvoiceNetSum' => $this->InvoiceNetSum,
            'InvoiceSum' => $this->InvoiceSum,
            'InvoiceCurrency' => $this->InvoiceCurrency,
            'RechnungsAdresse1' => $this->RechnungsAdresse1,
            'RechnungsAdresse2' => $this->RechnungsAdresse2,
            'Rechnungsstrasse' => $this->Rechnungsstrasse,
            'RechnungsPLZStadt' => $this->RechnungsPLZStadt,
            'RechnungsLand' => $this->RechnungsLand,
            'InfotextOben' => $this->InfotextOben,
            'InfotextUnten' => $this->InfotextUnten,
            'PriceScaleInfos' => $this->PriceScaleInfos,
            'Language' => $this->Language,
        );
    }

    public function addDetail(InvoiceDetail $detail) {
        $this->details[] = $detail;
    }

    public function getId(): string
    {
        return $this->InvoiceId;
    }
}