<?php
include(dirname(__FILE__).'/fpdf.php');
class PedidoPdf extends FPDF {
    
    public $javascript; 
    public $n_js;
    public $widthTotal;
    public $total = 0;
    public $fecha;
    public $pedido;
    public $money;
    
    public function __construct($pedido) {
        parent::__construct();
        $this->pedido = $pedido;
        $this->fecha = preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', '$3-$2-$1', $pedido->fecha);
    }

    function IncludeJS($script) { 
        $this->javascript=$script; 
    }

    function _putjavascript() { 
        $this->_newobj(); 
        $this->n_js=$this->n; 
        $this->_out('<<'); 
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]'); 
        $this->_out('>>'); 
        $this->_out('endobj'); 
        $this->_newobj(); 
        $this->_out('<<'); 
        $this->_out('/S /JavaScript'); 
        $this->_out('/JS '.$this->_textstring($this->javascript)); 
        $this->_out('>>'); 
        $this->_out('endobj'); 
    }

    function _putresources() { 
        parent::_putresources(); 
        if (!empty($this->javascript)) { 
            $this->_putjavascript(); 
        } 
    } 

    function _putcatalog() { 
        parent::_putcatalog(); 
        if (!empty($this->javascript)) { 
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>'); 
        } 
    } 
    
    function Header() {
        $this->SetFont('Arial','B',10);
        $this->Ln();
        $this->Cell(0, 0, 'Fecha: '.$this->fecha, 0, 0, 'R');
        $this->Ln(5);
        $this->SetFont('', '', 9);

        //datos del cliente - header
        $this->SetFont('Arial','B',10);
        $this->MultiCell(0, 5, 'REMITO: '.utf8_decode($this->pedido->id), 0);
        $this->SetFont('Arial', '', 10);
        $this->MultiCell(0, 5, 'Cliente: '.utf8_decode($this->pedido->cliente->razon_social), 0);
        $this->MultiCell(0, 5, 'Direccion: '.utf8_decode($this->pedido->cliente->direccion.', '.$this->pedido->cliente->localidad->value.' - '.$this->pedido->cliente->localidad->provincia->value), 0);
        $this->MultiCell(0, 5, 'Horario: '.utf8_decode($this->pedido->cliente->horario), 0);
        $this->Ln(5);
    }
    
    function cabecera ($header) {        
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(60);
        $this->SetTextColor(255);
        $this->SetDrawColor(60);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B', 8);
        // Cabecera
        $this->widthTotal = 0;
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($header[$i]['width'], 7, utf8_decode ($header[$i]['value']), 1, 0, 'C', true);
            $this->widthTotal += $header[$i]['width'];
        }
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 224, 224);
        $this->SetTextColor(0);
        $this->SetFont('', '', 9);
    }
    
    function fancyTable($header, $data) {
        $this->cabecera($header);
        $fill = false;
        $numRow = 0;
        foreach ($data as $row) {
            $i=0;
            if ($numRow++ >= 30) {
                $this->Cell($this->widthTotal, 0, '', 'T');
                $this->AddPage();
                $numRow = 0;
                $this->cabecera($header);
            }
            foreach ($row as $key=>$col) {
                if ($key == 'id') continue;
                if ($key == 'total') $this->total += $col;
                if (in_array($key, $this->money)) $col = '$ ' . number_format($col, 0, ',', '.');
                $this->Cell($header[$i]['width'], 7, utf8_decode($col), 'LR', 0, 'C', $fill);
                $i++;
            }
            $this->Ln();
            $fill = !$fill;
        }
        $this->pie();
    }
    
    private function pie () {
        // Línea de cierre
        $this->Cell($this->widthTotal, 0, '', 'T');
        $this->Ln();

        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0);
        $this->Cell($this->widthTotal, 7, 'Valor total: ' . '$ ' . number_format($this->total, 0, ',', '.') . '   ', 1, 0, 'R', true);
        $this->Ln();

        // Línea de cierre
        $this->Cell($this->widthTotal, 0, '', 'T');
    }
}
?>
