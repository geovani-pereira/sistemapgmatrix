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
			$this->Cell(276,10,'Serviços mais realizados',0,0,'C');
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
			$this->Cell(150,10,'NOME',1,0,'C');
			$this->Cell(40,10,'VALOR UN',1,0,'C');
			$this->Cell(20,10,'QTD',1,0,'C');
			$this->Cell(40,10,'VALOR TOTAL',1,0,'C');
			$this->Ln();
		} function viewTable($pdo){
			$this->SetFont('Times','',12);
			//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
			$select = $_SESSION['selectServicos'];
			$stmt = $pdo->query($select);
			while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
				$id = $dados->id;
				$nome = $dados->nome;
				$valor = $dados->valor;
				$valort = $dados->valort;
				$qtd = $dados->qtd;
				$valor = number_format( $valor, 2, "," , ".");
				$valort = number_format( $valort, 2, ",", ".");

				$this->Cell(20,10,$id,1,0,'C');
				$this->Cell(150,10,$nome,1,0,'L');
				$this->Cell(40,10,$valor,1,0,'L');
				$this->Cell(20,10,$qtd,1,0,'C');
				$this->Cell(40,10,$valort,1,0,'C');
				$this->Ln();
			}
		}
	}

	$pdf = new myPDF();
	$pdf->SetTitle('Relatorio de Serviços');
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($pdo);
	$pdf->Output();
?>
