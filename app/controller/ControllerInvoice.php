<?php
  //======================================================================
  // CONTROLLER - NOTA FISCAL
  //======================================================================
  namespace App\Controller;

  use App\Model\DTO\InvoiceDTO;
  use App\Model\ModelInvoice;

class ControllerInvoice
{

	private ModelInvoice $invoiceModel;

	public function __construct()
	{
		$this->invoiceModel = new ModelInvoice();
	}

	
	public function insert(InvoiceDTO $note): bool
	{   
		return $this->invoiceModel->insert($note);
	}

	public function update(InvoiceDTO $note): bool
	{
		return $this->invoiceModel->update($note);
	}

	public function delete(int $id): bool
	{
		return $this->invoiceModel->delete($id);
	}

	public function selectAll(): array
	{
		return $this->invoiceModel->selectAll();
	}

	public function selectById(int $id): InvoiceDTO
	{
		return $this->invoiceModel->selectById($id);
	}

}