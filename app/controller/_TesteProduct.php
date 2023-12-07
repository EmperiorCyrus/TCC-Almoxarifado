<?php
require "ControllerInvoice.php";
//require "../model/DTO/InvoiceDTO.php";
$controller = new ControllerInvoice();

// Obtém uma lista de todas as notas
$notes = $controller->selectAll();
var_dump($notes);

// Obtém uma nota específica pelo id
//$note = $controller->get_note(1);

// Cria uma nova nota
$noteDTO = new InvoiceDTO("teste03", "teste03", "teste03");
$note = $controller->insert($noteDTO);
var_dump($note);

// Atualiza uma nota existente
// $noteDTO->description = "Esta nota foi atualizada";
// $controller->update_note($noteDTO);

// Exclui uma nota existente
// $controller->delete_note(1);
