<?php 

	class puntodeventaModel extends Mysql
	{
		/************************* TABLE db_PRODUCTOS ******************************/
		private $idproveedor;
		private $imagen;
		private $proveedor;
		private $descripcion;
		private $estado;
		private $fecha_actializacion;
		private $fecha_creacion;


		public function __construct()
		{
			parent::__construct();
		}	
    
    }