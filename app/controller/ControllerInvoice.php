<?php
  //======================================================================
  // CONTROLLER - NOTA FISCAL
  //======================================================================
  namespace App\Controller;

  use App\Model\DTO\InvoiceDTO;
  use App\Model\ModelInvoice;

class ControllerInvoice
{

	private $invoiceModel = [];

	public function __construct()
	{
		$this->invoiceModel = new ModelInvoice();
	}

	
	public function save(InvoiceDTO $note)
	{   
		return $this->invoiceModel->insert($note);
	}

	public function edit(InvoiceDTO $note): bool
	{
		return $this->invoiceModel->update($note);
	}

	public function delete(int $id)
	{
		return $this->invoiceModel->delete($id);
	}

	public function index(): array
	{
		return $this->invoiceModel->selectAll();
	}

	public function selectById(int $id): InvoiceDTO
	{
		return $this->invoiceModel->selectById($id);
	}
}

