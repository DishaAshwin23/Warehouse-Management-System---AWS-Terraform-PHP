<?php
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class TCPDF_gen {
		public function __construct() {
			require_once APPPATH.'third_party/TCPDF-main/tcpdf.php';
		
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);;

		
			$CI =& get_instance();
			$CI->tcpdf = $pdf;
		}
	}