<?php 
session_start();

//echo "$select";
	$selectProdutosTipo = $_SESSION['selectProdutosTipo'];

	
	if ( $selectProdutosTipo == "mv" ) {
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
				$this->Cell(276,10,'Produtos',0,0,'C');
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
				$this->Cell(20,5,'ID',1,0,'C');
				$this->Cell(125,5,'NOME',1,0,'C');
				$this->Cell(60,5,'MARCA',1,0,'C');
				$this->Cell(20,5,'QTD',1,0,'C');
				$this->Cell(30,5,'VALOR T',1,0,'C');
				$this->Cell(25,5,'DATA',1,0,'C');
				$this->Ln();
			} function viewTable($pdo){
				$this->SetFont('Times','',12);
				//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
				$select = $_SESSION['selectProdutos'];
				$stmt = $pdo->query($select);
				while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
					$id = $dados->id;
					$nome = $dados->nome;
					$marca = $dados->marca;
					$vendidos = $dados->vendidos;
					$valorTotal = $dados->valorTotal;
					$datainicial = $dados->datainicial;
					$datainicial = date('d/m/Y', strtotime($datainicial));
					$valorTotal = number_format( $valorTotal, 2, "," , ".");

					$this->Cell(20,5,$id,1,0,'C');
					$this->Cell(125,5,$nome,1,0,'L');
					$this->Cell(60,5,$marca,1,0,'L');
					$this->Cell(20,5,$vendidos,1,0,'C');
					$this->Cell(30,5,$valorTotal,1,0,'L');
					$this->Cell(25,5,$datainicial,1,0,'L');
					$this->Ln();
				}
			}
		}

		$pdf = new myPDF();
		$pdf->SetTitle('Relatorio de Produtos');
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4',0);
		$pdf->headerTable();
		$pdf->viewTable($pdo);
		$pdf->Output();
	} else {
		require "fpdf.php";
		include "conecta.php";

		class myPDF extends FPDF{
			function header(){
				$this->Image('imagens/logopdf.png',10,3);
				$this->SetFont('Arial','B',14);
				$this->Cell(276,05,'RELATÓRIO ',0,0,'C');
				$this->Ln();
				$this->SetFont('Times','',12);
				$this->Cell(276,10,'Produtos',0,0,'C');
				$this->Ln(20);
			}
			function footer(){
				$this->SetY(-15);
				$this->SetFont('Arial','',8);
				$this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
			}
			function headerTable(){
				$this->SetFont('Times','B',12);
				$this->Cell(20,5,'ID',1,0,'C');
				$this->Cell(155,5,'NOME',1,0,'C');
				$this->Cell(60,5,'MARCA',1,0,'C');
				$this->Cell(15,5,'ETQ',1,0,'C');
				$this->Cell(20,5,'VALOR',1,0,'C');
				$this->Ln();
			} function viewTable($pdo){
				$this->SetFont('Times','',12);
				//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
				$select = $_SESSION['selectProdutos'];
				$stmt = $pdo->query($select);
				while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
					$id = $dados->id;
					$nome = $dados->nome;
					$marca = $dados->marca;
					$estoque = $dados->estoque;
					$valor = $dados->valor;
					$valor = number_format( $valor, 2, "," , ".");

					$this->Cell(20,5,$id,1,0,'C');
					$this->Cell(155,5,$nome,1,0,'L');
					$this->Cell(60,5,$marca,1,0,'L');
					$this->Cell(15,5,$estoque,1,0,'L');
					$this->Cell(20,5,$valor,1,0,'L');
					$this->Ln();
				}
			}
		}

		$pdf = new myPDF();
		$pdf->SetTitle('Relatorio de Produtos');
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4',0);
		$pdf->headerTable();
		$pdf->viewTable($pdo);
		$pdf->Output();
	}
?>
