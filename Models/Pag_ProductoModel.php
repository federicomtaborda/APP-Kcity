<?php 

	class Pag_ProductoModel extends Mysql
	{
		/************************* TABLE db_PRODUCTOS ******************************/
		private $idproducto;
		private $imagen;
		private $codigo;
		private $producto;
		private $descripcion;
		private $costo;
		private $precio;
		private $stock;
		private $intStock;
		private $id_categoria;
		private $id_proveedor;
		private $estado;
		private $fecha_actializacion;
		private $fecha_creacion;


		public function __construct()
		{
			parent::__construct();
		}	

		/************************* BUSCAR UN PRODUCTOS ******************************/

		public function getProducto(int $id){
			$this->id_Producto = $id;
			$sql = "SELECT
			db_productos.id,
			db_productos.imagen,
			db_productos.codigo,
			db_productos.producto,
			db_productos.descripcion,
			db_productos.costo,
			db_productos.precio,
			db_productos.stock,
			db_productos.stock_min,
			db_productos.id_categoria,
			db_productos.id_proveedor,
			db_productos.estado,
			db_productos.fecha_actualizacion,
			db_productos.fecha_creacion,
			db_proveedores.proveedor,
			db_categorias.categoria
			FROM
			db_categorias
			INNER JOIN db_productos ON db_productos.id_categoria = db_categorias.id_categoria
			INNER JOIN db_proveedores ON db_productos.id_proveedor = db_proveedores.id_proveedor
			WHERE db_productos.id = $this->id_Producto";
			$request = $this->select($sql);
			return $request;
		}

		public function insertProducto(string $producto, string $codigo, string $descripcion, string $costo,
		string $precio, int $stock, int $stock_minimo, int $categoria, int $proveedor, int $estado){

				$this->prodcuto = $producto;
				$this->codigo = $codigo;
				$this->descripcion = $descripcion;
				$this->costo = $costo;
				$this->precio = $precio;
				$this->stock = $stock;
				$this->stock_minimo = $stock_minimo;
				$this->id_categoria = $categoria;
				$this->id_proveedor = $proveedor;
				$this->estado = $estado;
				$return = 0;
				/*** VERIFICA SI EXISTE UN PRODUCTO CON ESE CODIGO***/
				$sql = "SELECT * FROM db_productos WHERE codigo = '{$this->codigo}'";
				$request = $this->select_all($sql);
				
				if(empty($request))
				{
					$sql = "INSERT INTO db_productos 
								(producto,
								codigo,
								descripcion,
								costo,
								precio,
								stock,
								stock_min,
								id_categoria,
								id_proveedor,
								estado)
								VALUES(?,?,?,?,?,?,?,?,?,?)";
						$arrData = array(
										$this->prodcuto = ucfirst($producto),
										$this->codigo = $codigo,
										$this->descripcion = $descripcion,
										$this->costo = $costo,	
										$this->precio = $precio,
										$this->stock = $stock,
										$this->stock_minimo = $stock_minimo,
										$this->id_categoria = $categoria,
										$this->id_proveedor = $proveedor,
										$this->estado = $estado);
	
					$request = $this->insert($sql,$arrData);
					$return = $request;
				}else{
					
					$return = 0;
				}
				return $return;
			}

			/************************* ACTUALIZA PRODUCTO DESDE MODAL ******************************/
		
			
			public function updateProducto(int $idproducto, string $codigo, string $producto, string $descripcion, int $costo, int $precio, 
						int $stock, int $stock_minimo, int $categoria, int $proveedor, int $estado)
				{
				$this->idproducto = $idproducto;
				$this->codigo = $codigo;
				$this->prodcuto = $producto;
				$this->descripcion = $descripcion;
				$this->costo = $costo;
				$this->precio = $precio;
				$this->stock = $stock;
				$this->stock_minimo = $stock_minimo;
				$this->id_categoria = $categoria;
				$this->id_proveedor = $proveedor;
				$this->estado = $estado;
				$return = 0;
				$sql = "SELECT * FROM db_productos WHERE codigo = '{$this->codigo}'";
				$request = $this->select_all($sql);

			if(!empty($request))
			{
				$sql = "UPDATE db_productos
						SET producto=?,
							descripcion=?,
							costo=?,
							precio=?,
							stock=?,
							stock_min=?,
							id_categoria=?,
							id_proveedor=?,
							estado=?
							WHERE id = $this->idproducto ";
							
					$arrData = array(
									//NOMBRE DE PRODUCTO CAPITALIZE
									$this->prodcuto = ucfirst($producto),
									$this->descripcion = $descripcion,
									$this->costo = $costo,
									$this->precio = $precio,
									$this->stock = $stock,
									$this->stock_minimo = $stock_minimo,
									$this->categoria = $categoria,
									$this->proveedor = $proveedor,
									$this->estado = $estado);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
				
			}else{
				
				$return = 0;
			}
	        return $return;
		}




        
	}
 ?>