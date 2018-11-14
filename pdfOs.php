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
			$this->Cell(276,10,'Ordem de Serviço',0,0,'C');
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
			$this->Cell(25,10,'DATA',1,0,'C');
			$this->Cell(30,10,'STATUS',1,0,'C');
			$this->Cell(90,10,'DESCRIÇÃO',1,0,'C');
			$this->Cell(40,10,'USUARIO',1,0,'C');
			$this->Cell(80,10,'NOME',1,0,'C');
			
			$this->Ln();
		} function viewTable($pdo){
			$this->SetFont('Times','',12);
			//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
			$select = $_SESSION['selectOs'];
			$stmt = $pdo->query($select);
			while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
				$id = $dados->id;
				$datainicial = $dados->datainicial;
				$status = $dados->status;
				$descricao = $dados->descricao;
				$usuario = $dados->usuario;
				$nome = $dados->nome;
				$datainicial = date('d/m/Y', strtotime($datainicial));

				$this->Cell(20,10,$id,1,0,'C');
				$this->Cell(25,10,$datainicial,1,0,'L');
				$this->Cell(30,10,$status,1,0,'L');
				$this->Cell(90,10,$descricao,1,0,'L');
				$this->Cell(40,10,$usuario,1,0,'L');
				$this->Cell(80,10,$nome,1,0,'L');
				$this->Ln();
			}
		}
	}

	$pdf = new myPDF();
	$pdf->SetTitle('Relatorio de Ordem de Serviço');
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($pdo);
	$pdf->Output();
?>
