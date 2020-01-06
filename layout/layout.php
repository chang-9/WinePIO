<?php
	session_start();
	header('Content-Type: text/html; charset=utf-8');
	//header('Content-Type: application/json');

	include 'head.php';
    include 'header.php';
    include 'sideMenu.php';
	include 'footer.php';
	include 'js.php';

	class Layout
	{
		public $CssJsF,$JsF,
		       $head,$headerF,$sideMenu,$footer,$js;

        //head에 들어갈 css and js
		public function CssJsFile($CssJsF)
		{
			$this->CssJsF=$CssJsF;
		}

		//하단에 들어갈 js파일
		public function JsFile($JsF)
		{
			$this->JsF=$JsF;
		}

        //head 출력
		public function head($head)
		{
			$this->head = $head;
			echo $this->head.$this->CssJsF."</head>";
		}
        
        //레이아웃 헤더
		public function headerF($headerF)
		{
			$this->headerF = $headerF;
			echo $this->headerF;
		}

        //사이드 메뉴
		public function sideMenu($sideMenu)
		{
			$this->sideMenu = $sideMenu;
			echo $this->sideMenu;
		}

        //footer
		public function footer($footer)
		{
			$this->footer = $footer;
			echo $this->footer;
		}

        //하단 스크립트
		public function js($js)
		{
			$this->footer = $js;
			echo $this->footer.$this->JsF;
		}
	}
?>