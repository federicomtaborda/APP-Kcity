<?php 

	class puntodeventa extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

        public function puntodeventa()
		{
			$data['page_id'] = 2;
			$data['page_home'] = "Inicio";
			$data['page_name'] = "Listado de Categorias";
			//$data['page_functions_js'] = "puntodeventa.js";
			$this->views->getView($this,"puntodeventa",$data);
		}

}