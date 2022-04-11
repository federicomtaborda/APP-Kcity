<?php
	class CategoriasModel extends Mysql
	{
		/************************* TABLE db_PRODUCTOS ******************************/
		private $idCategoria;
		private $imagen;
		private $categoria;
		private $descripcion;
		private $estado;

		public function __construct()
		{
			parent::__construct();
		}

        /***** SELECT CATEGORIAS HABILITADAS ****/
        public function getCategorias()
		{
			$sql = "SELECT
			db_categorias.id_categoria,
			db_categorias.imagen,
			db_categorias.categoria,
			db_categorias.descripcion,
			db_categorias.estado
			FROM
			db_categorias
			ORDER BY
			db_categorias.categoria ASC";
			$request = $this->select_all($sql);
			return $request;
		}

		/***** SELECT CATEGORIA HABILITADAS ****/
		public function selectCategorias()
		{
			$sql = "SELECT * FROM db_categorias
					WHERE estado != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCategoria(int $idCategoria){
			$this->idCategoria = $idCategoria;
			$sql = "SELECT
					db_categorias.id_categoria,
					db_categorias.imagen,
					db_categorias.categoria,
					db_categorias.descripcion,
					db_categorias.estado
					FROM
					db_categorias
					WHERE
					db_categorias.id_categoria = $this->idCategoria";
			$request = $this->select($sql);
			return $request;

		}


		public function insertCategoria(string $categoria, string $descripcion, int $estado){

			$return = 0;
			$this->categoria = $categoria;
			$this->descripcion = $descripcion;
			$this->estado = $estado;

			$sql = "SELECT * FROM db_categorias WHERE categoria = '{$this->categoria}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO db_categorias(categoria,descripcion,estado) VALUES(?,?,?)";
	        	$arrData = array($this->categoria, 
								 $this->descripcion, 
								 $this->estado);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function updateCategoria(int $idCategoria, string $categoria, string $descripcion, int $estado){
			$this->idCategoria = $idCategoria;
			$this->categoria = $categoria;
			$this->descripcion = $descripcion;
			$this->estado = $estado;

			$sql = "SELECT * FROM db_categorias WHERE categoria = '{$this->categoria}' AND id_categoria != $this->idCategoria";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE db_categorias SET categoria = ?, descripcion = ?, estado = ? WHERE id_categoria = $this->idCategoria";
				$arrData = array(
								 $this->categoria, 
								 $this->descripcion,
								 $this->estado);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}

		public function deleteCategoria(int $idcategoria){
			$this->IdCategoria = $idcategoria;
			$sql = "UPDATE db_categorias SET estado = 2 WHERE id_categoria = $this->IdCategoria ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}
    
    
    
    
    }