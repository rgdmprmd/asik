<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Call tcpdf
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class Pdf_report extends TCPDF
{
    public function Header()
    {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = APPPATH . 'assets/img/illustrat/wrinkled-paper-texture.jpg';
        $this->Image($img_file, 0, 0, 160, 250, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}
