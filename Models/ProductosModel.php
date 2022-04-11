<?php 

	class ProductosModel extends Mysql
	{
		
		private $idproducto;
		private $precio;
		private $stock;
		private $stock_minimo;
		private $categoriaid;
		private $categoria;
		private $proveedor;


		public function __construct()
		{
			parent::__construct();
		}	

		/************************* LISTADO DE PRODUCTOS ******************************/
		public function selectProductos(){
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
			ORDER BY
			db_productos.producto ASC";
			$request = $this->select_all($sql);
			return $request;
		}

		/************************* BUSCAR UN PRODUCTO ******************************/

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

		/************************* ACTUALIZA PRODUCTO DESDE MODAL ******************************/
		public function updateProducto(int $idproducto, int $precio, int $stock, int $stock_minimo, int $categoria, int $proveedor, int $estado){
			$this->idproducto = $idproducto;
			$this->precio = $precio;
			$this->stock = $stock;
			$this->stock_minimo = $stock_minimo;
			$this->categoria = $categoria;
			$this->proveedor = $proveedor;
			$this->estado = $estado;
			$return = 0;
			$sql = "SELECT * FROM db_productos WHERE id = '{$this->idproducto}'";
			$request = $this->select_all($sql);

			if(!empty($request))
			{
				$sql = "UPDATE db_productos
						SET precio=?,
							stock=?,
							stock_min=?,
							id_categoria=?,
							id_proveedor=?,
							estado=?
						WHERE id = $this->idproducto ";
					$arrData = array(
									$this->precio = $precio,
									$this->stock = $stock,
									$this->stock_minimo = $stock_minimo,
									$this->categoria = $categoria,
									$this->proveedor = $proveedor,
									$this->estado = $estado);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE db_productos SET estado = 2 WHERE id = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

	}
 ?>