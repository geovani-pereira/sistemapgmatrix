<?php 
session_start();

//echo "$select";

	require "fpdf.php";
	include "conecta.php";

	class myPDF extends FPDF{
		function header(){
			$date = date('d-m-Y H:i');
			$this->Image('imagens/logopdf.png',10,3);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,05,'RELATÓRIO ',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(276,10,'Despesas',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(276,10,"Data e Hora: ". $date,0,0,'C');
			$this->Ln(20);
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(20,10,'ID',1,0,'C');
			$this->Cell(140,10,'DESCRIÇÃO',1,0,'C');
			$this->Cell(40,10,'VALOR R$',1,0,'C');
			$this->Cell(40,10,'DATA',1,0,'C');
			$this->Cell(40,10,'STATUS',1,0,'C');
			$this->Ln();
		} function viewTable($pdo){
			$this->SetFont('Times','',12);
			//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
			$select = $_SESSION['selectDespesas'];
			$stmt = $pdo->query($select);
			while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
				$id = $dados->id;
				$descricao = $dados->descricao;
				$valor = $dados->valor;
				$data = $dados->data;
				$conta = $dados->conta;
				$valor = $dados->valor;
				$valor = number_format( $valor, 2, "," , ".");
				$data = date('d/m/Y', strtotime($data));

				$this->Cell(20,10,$id,1,0,'C');
				$this->Cell(140,10,$descricao,1,0,'L');
				$this->Cell(40,10,$valor,1,0,'L');
				$this->Cell(40,10,$data,1,0,'L');
				$this->Cell(40,10,$conta,1,0,'L');
				$this->Ln();
			}
		}
	}

	$pdf = new myPDF();
	$pdf->SetTitle('Relatorio de Despesas');
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($pdo);
	$pdf->Output();
?>
