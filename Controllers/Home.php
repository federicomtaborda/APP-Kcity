<?php 

	class Home extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function home()
		{
			$data['page_id'] = 1;
			$data['page_home'] = "Panel Principal";
			$data['page_name'] = "Inicio";
			$this->views->getView($this,"home",$data);
		}

	}
 ?>