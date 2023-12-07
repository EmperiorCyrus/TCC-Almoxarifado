<?php
  //======================================================================
  // CONTROLLER - NOTA FISCAL
  //======================================================================
  namespace App\Controller;

  use App\Model\DTO\InvoiceDTO;
  use App\Model\ModelInvoice;

class ControllerInvoice
{

	private ModelInvoice $noteModel;

	public function __construct()
	{
		$this->noteModel = new ModelInvoice();
	}

	public function selectAll(): array
	{
		return $this->noteModel->selectAll();
	}

	public function selectById(int $id): InvoiceDTO
	{
		return $this->noteModel->selectById($id);
	}

	public function insert(InvoiceDTO $note): bool
	{   
		return $this->noteModel->insert($note);
	}

	public function update(InvoiceDTO $note): bool
	{
		return $this->noteModel->update($note);
	}

	public function delete(int $id): bool
	{
		return $this->noteModel->delete($id);
	}
}