<?php 
session_start();

//echo "$select";
	$buscaCliente = $_SESSION['buscaCliente'];


	
	if ( $buscaCliente == "clienteCompras" ) {
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
				$this->Cell(276,10,'Clientes que mais compraram',0,0,'C');
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
				$this->Cell(145,5,'NOME',1,0,'C');
				$this->Cell(60,5,'CPF / CNPJ',1,0,'C');
				$this->Cell(40,5,'VALOR R$',1,0,'C');
				$this->Ln();
			} function viewTable($pdo){
				$this->SetFont('Times','',12);
				//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
				$select = $_SESSION['selectCliente'];
				$stmt = $pdo->query($select);
				while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
					$id = $dados->id;
					$nome = $dados->nome;
					$cpfcnpj = $dados->cpfcnpj;
					$valor = $dados->valor;
					$valor = number_format( $valor, 2, "," ,"." );

					$this->Cell(20,5,$id,1,0,'C');
					$this->Cell(145,5,$nome,1,0,'L');
					$this->Cell(60,5,$cpfcnpj,1,0,'L');
					$this->Cell(40,5,$valor,1,0,'L');
					$this->Ln();
				}
			}
		}

		$pdf = new myPDF();
		$pdf->SetTitle('Relatorio de Cliente');
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4',0);
		$pdf->headerTable();
		$pdf->viewTable($pdo);
		$pdf->Output();

	} else if ( $buscaCliente == "total" ){
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
				$this->Cell(276,10,'Clientes - Valor Total em Débito',0,0,'C');
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
				$this->Cell(130,5,'NOME',1,0,'C');
				$this->Cell(60,5,'CPF / CNPJ',1,0,'C');
				$this->Cell(35,5,'VALOR TOTAL',1,0,'C');
				$this->Cell(30,5,'VENCIMENTO',1,0,'C');
				$this->Ln();
			} function viewTable($pdo){
				$this->SetFont('Times','',12);
				//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
				$select = $_SESSION['selectCliente'];
				$stmt = $pdo->query($select);
				while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
					$id = $dados->id;
					$nome = $dados->nome;
					$cpfcnpj = $dados->cpfcnpj;
					$valor = $dados->valor;
					$datavcto = $dados->datavcto;
					$valor = number_format( $valor, 2, "," ,"." );
					$datavcto = date('d/m/Y', strtotime($datavcto));

					$this->Cell(20,5,$id,1,0,'C');
					$this->Cell(130,5,$nome,1,0,'L');
					$this->Cell(60,5,$cpfcnpj,1,0,'L');
					$this->Cell(35,5,$valor,1,0,'L');
					$this->Cell(30,5,$datavcto,1,0,'L');
					$this->Ln();
				}
			}
		}

		$pdf = new myPDF();
		$pdf->SetTitle('Relatorio de Cliente');
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4',0);
		$pdf->headerTable();
		$pdf->viewTable($pdo);
		$pdf->Output();
	} else if ($buscaCliente == "pendente") {
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
				$this->Cell(276,10,'Clientes com Parcelas Pendente',0,0,'C');
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
				$this->Cell(65,5,'NOME',1,0,'C');
				$this->Cell(35,5,'CPF / CNPJ',1,0,'C');
				$this->Cell(25,5,'ID ORDEM',1,0,'C');
				$this->Cell(70,5,'DESCRIÇÃO',1,0,'C');
				$this->Cell(35,5,'VALOR TOTAL',1,0,'C');
				$this->Cell(30,5,'VENCIMENTO',1,0,'C');
				$this->Ln();
			} function viewTable($pdo){
				$this->SetFont('Times','',12);
				//$select = "select *, date_format(data, '%d/%m/%Y') data from conta order by id desc";
				$select = $_SESSION['selectCliente'];
				$stmt = $pdo->query($select);
				while($dados = $stmt->fetch(PDO::FETCH_OBJ)){
					$id = $dados->id;
					$nome = $dados->nome;
					$cpfcnpj = $dados->cpfcnpj;
					$id_ordem = $dados->id_ordem;
					$descricao = $dados->descricao;
					$valor = $dados->valor;
					$datavcto = $dados->datavcto;
					$valor = number_format( $valor, 2, "," ,"." );
					$datavcto = date('d/m/Y', strtotime($datavcto));

					$this->Cell(20,5,$id,1,0,'C');
					$this->Cell(65,5,$nome,1,0,'L');
					$this->Cell(35,5,$cpfcnpj,1,0,'L');
					$this->Cell(25,5,$id_ordem,1,0,'L');
					$this->Cell(70,5,$descricao,1,0,'L');
					$this->Cell(35,5,$valor,1,0,'L');
					$this->Cell(30,5,$datavcto,1,0,'L');
					$this->Ln();
				}
			}
		}

		$pdf = new myPDF();
		$pdf->SetTitle('Relatorio de Cliente');
		$pdf->AliasNbPages();
		$pdf->AddPage('L','A4',0);
		$pdf->headerTable();
		$pdf->viewTable($pdo);
		$pdf->Output();
	}
?>
