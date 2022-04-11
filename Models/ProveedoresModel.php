<?php 

	class ProveedoresModel extends Mysql
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


          /***** SELECT PROVEEDOR HABILITADAS ****/
          public function selectProveedor()
          {
              $sql = "SELECT * FROM db_proveedores
                      WHERE estado != 0";
              $request = $this->select_all($sql);
              return $request;
          }

		  /***** SELECT PROVEEDORES ****/
		  public function getProveedores()
		  {
			  $sql = "SELECT
			  db_proveedores.id_proveedor,
			  db_proveedores.imagen,
			  db_proveedores.proveedor,
			  db_proveedores.descripcion,
			  db_proveedores.fecha_cracion,
			  db_proveedores.estado
			  FROM
			  db_proveedores
			  ORDER BY
			  db_proveedores.proveedor ASC
			  ";
			  $request = $this->select_all($sql);
			  return $request;
		  }

		  /***** SELECT POR ID DE PROVEEDOR ****/
		  public function getProveedor(int $idproveedor){
			$this->id_proveedor = $idproveedor;
			$sql = "SELECT
					db_proveedores.id_proveedor,
					db_proveedores.imagen,
					db_proveedores.proveedor,
					db_proveedores.descripcion,
					db_proveedores.fecha_cracion,
					db_proveedores.estado
					FROM
					db_proveedores
					WHERE
					db_proveedores.id_proveedor = $this->id_proveedor";
			$request = $this->select($sql);
			return $request;
			
			}

			/***** DELETE PROVEEDOR ****/
			public function deleteproveedor(int $idproveedor){
				$this->id_proveedor = $idproveedor;
				$sql = "UPDATE db_proveedores SET estado = 2 WHERE id_proveedor = $this->id_proveedor ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				return $request;
			}

			public function insertProveedor(string $proveedor, string $descripcion, int $estado){

				$return = 0;
				$this->proveedor = $proveedor;
				$this->descripcion = $descripcion;
				$this->estado = $estado;
	
				$sql = "SELECT * FROM db_proveedores WHERE proveedor = '{$this->proveedor}' ";
				$request = $this->select_all($sql);
	
				if(empty($request))
				{
					$query_insert  = "INSERT INTO db_proveedores (proveedor,descripcion,estado) VALUES(?,?,?)";
					$arrData = array($this->proveedor, 
									 $this->descripcion, 
									 $this->estado);
					$request_insert = $this->insert($query_insert,$arrData);
					$return = $request_insert;
				}else{
					$return = "exist";
				}
				return $return;
			}
	
			public function updateProveedor(int $idproveedor, string $proveedor, string $descripcion, int $estado){
				
				$this->id_proveedor = $idproveedor;
				//var_dump($idProveedor); exit();
				$this->proveedor = $proveedor;
				$this->descripcion = $descripcion;
				$this->estado = $estado;
	
				$sql = "SELECT * FROM db_proveedores WHERE proveedor = '{$this->proveedor}' AND id_proveedor != $this->id_proveedor";
				$request = $this->select_all($sql);
	
				if(empty($request))
				{
					$sql = "UPDATE db_proveedores SET proveedor = ?, descripcion = ?, estado = ? WHERE id_proveedor = $this->id_proveedor";
					$arrData = array(
									 $this->proveedor, 
									 $this->descripcion,
									 $this->estado);
					$request = $this->update($sql,$arrData);
				}else{
					$request = "exist";
				}
				return $request;			
			}
	
    
    
    
    
    
	
	
	
	
		}