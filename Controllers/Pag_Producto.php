<?php 

	class Pag_Producto extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function pag_producto()
		{
			$data['page_id'] = 3;
			$data['page_home'] = "Inicio";
			$data['page_name'] = "Pagina de Producto";
			$data['page_functions_js'] = "pag_producto.js";

			/*****  si id o new son vacios - vuelve al index*****/
			if ( empty($_GET['id']) && empty($_GET['new']) ){

				header( 'Location:'.base_url().'' );
			
			/*****  si envia id, es numerico y new vacio *****/	
			}elseif(!empty($_GET['id']) && is_numeric($_GET['id']) && empty($_GET['new'])){

				$data['tipo_name'] = "Actualización de Producto";
				$id = $_GET['id'];
				$arrData = $this->model->getProducto($id);
				
				$data['producto'] = $arrData;

				if($arrData){

					$this->views->getView($this,"pag_producto",$data);
				}else{
					header( 'Location:'.base_url().'/productos' );
				}

			/*****  si envia new y id vacio *****/	
			}elseif( (!empty($_GET['new'])) && empty($_GET['id']) ){

			$data['tipo_name'] = "Ingreso de nuevo Producto";

			$fecha_actual = date('m/d/Y');

			$data['producto'] = array(
				"id" => "", 
				"codigo" => "",
				"producto" => '',
				"descripcion" => '',
				"costo" => '',
				"precio" => '',
				"stock" => '',
				"stock_min" => '',
				"id_categoria" => 'seleccione categoria..',
				"id_categoria" => 'seleccione proveedor..',
				"fecha_creacion" => $fecha_actual
				);



			$this->views->getView($this,"pag_producto",$data);

			}else{
				
				header( 'Location:'.base_url().'' );
			}

		} 

		/************************* GUARDAR UN PRODUCTO******************************/
		public function setProducto(){

			if($_POST){

				if(empty(empty($_POST['producto']) || $_POST['codigo']) || empty($_POST['costo']) 
				|| empty($_POST['precio']) || empty($_POST['stock']) || empty($_POST['stock_minimo']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}else{
					$id_producto = intval($_POST['idproducto']);
					$producto = strClean($_POST['producto']);
					$codigo = strClean($_POST['codigo']);
					$descripcion = strClean($_POST['descripcion']);
					$costo = intval($_POST['costo']);
					$precio = intval($_POST['precio']);
					$stock = intval($_POST['stock']);
					$stock_minimo = intval($_POST['stock_minimo']);
					$categoria = intval($_POST['categorias']);
					$proveedor = intval($_POST['proveedores']);
					$estado = intval($_POST['estado']);

					if($id_producto == 0)
					{	

						$request_producto = $this->model->insertProducto($producto,
																	$codigo,
																	$descripcion,
																	$costo,	
																	$precio,
																	$stock, 
																	$stock_minimo, 
																	$categoria, 
																	$proveedor, 
																	$estado);
					}else{

						$request_producto = $this->model->updateProducto(
																	$id_producto,
																	$codigo,
																	$producto,
																	$descripcion,
																	$costo,	
																	$precio,
																	$stock, 
																	$stock_minimo, 
																	$categoria, 
																	$proveedor, 
																	$estado);
						
					}

					if( $request_producto > 0 )
					{
						$arrResponse = array('status' => true, 'data' => $request_producto, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'El codigo del producto ya Existe.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}	
			}
		}


}


	
 ?>