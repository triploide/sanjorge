<?php
include(dirname(__FILE__).'/fpdf.php');
class ProductoPdf extends FPDF {
    
    public $javascript; 
    public $n_js;
    public $widthTotal;
    public $fecha;
    public $money = [];
    
    public function __construct($fecha) {
        parent::__construct();
        $this->fecha = $fecha;
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
            if ($numRow++ >= 35) {
                $this->Cell($this->widthTotal, 0, '', 'T');
                $this->AddPage();
                $numRow = 0;
                $this->cabecera($header);
            }
            foreach ($row as $key=>$col) {
                if ($key == 'id') continue;
                if (in_array($key, $this->money)) $col = '$ ' . number_format($col, 0, ',', '.');
                $this->Cell($header[$i]['width'], 7, utf8_decode($col), 'LR', 0, 'C', $fill);
                $i++;
            }
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell($this->widthTotal, 0, '', 'T');
    }

}
?>
