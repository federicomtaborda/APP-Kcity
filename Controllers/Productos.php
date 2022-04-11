<?php 

	class Productos extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function productos()
		{
			$data['page_id'] = 2;
			$data['page_home'] = "Inicio";
			$data['page_name'] = "Productos";
			$data['page_functions_js'] = "productos.js";
			$this->views->getView($this,"productos",$data);
		}

		/************************* LISTADO DE PRODUCTOS ******************************/
		public function getProductos()
		{
				$arrData = $this->model->selectProductos();
				for ($i=0; $i < count($arrData); $i++) {
					
					$btnView =''; 
					$btnEdit = '';
					$btnDelete ='';

					$arrData[$i]['costo'] = SMONEY.' '.formatMoney($arrData[$i]['costo']);

					$arrData[$i]['precio'] = 
					''.SMONEY.' '.formatMoney($arrData[$i]['precio']).'<span style="cursor:pointer"; title="editar producto" onClick="fntEditInfo(this,'.$arrData[$i]['id'].')"> 
						<i class="fas fa-exchange-alt"></i>
						</span>';


					$arrData[$i]['producto'] = '<a href="pag_producto?id='.$arrData[$i]['id'].'">
													'.$arrData[$i]['producto'].
												'</a>';
					if($arrData[$i]['estado'] == 1)
						{
						$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
						}else{
						$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					if($arrData[$i]['stock'] < $arrData[$i]['stock_min']){

						$arrData[$i]['stock'] = '<span class="text-danger">'.$arrData[$i]['stock'].'</span>';
					}else{

						$arrData[$i]['stock'] = '<span class="text-success">'.$arrData[$i]['stock'].'</span>';
					}

					$btnEdit = '<a type="buuton" class="btn btn-xs" title="editar producto"
									href="pag_producto?id='.$arrData[$i]['id'].'"><i class="fas fa-pencil-alt"></i>
								</a>';

					$btnDelete = '<button type="buuton" class="btn btn-xs" title="borrar producto" onClick="deleteProducto('.$arrData[$i]['id'].')">
									<i class="fas fa-trash-alt"></i>
								</button>';			

					$arrData[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';								
					

				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}

			/************************* LISTA UN PRODUCTO ******************************/

			public function getProducto($idproducto){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->getProducto($idproducto);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
	
			}	

			/************************* GUARDA O ACTUALIZA UN PRODUCTO******************************/
			public function setProducto(){

				if($_POST){

					if(empty($_POST['precio']) || empty($_POST['stock']) || empty($_POST['stock_minimo']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					}else{
						$idproducto = intval($_POST['id']);
						$precio = strClean($_POST['precio']);
						$stock = intval($_POST['stock']);
						$stock_minimo = intval($_POST['stock_minimo']);
						$categoria = intval($_POST['categorias']);
						$proveedor = intval($_POST['proveedores']);
						$estado = intval($_POST['estado']);

						if($idproducto != 0)
						{	//ACTUALIZA
							$option = 1;

							$request_producto = $this->model->updateProducto($idproducto, 
																		$precio,
																		$stock, 
																		$stock_minimo, 
																		$categoria, 
																		$proveedor, 
																		$estado);
						}

						if($request_producto > 0 )
						{
							if($option == 1){
								$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
							}
							echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
						}
					}	
				}
			}


			public function delProducto(){
				if($_POST){
						$intIdproducto = intval($_POST['idProducto']);
						$requestDelete = $this->model->deleteProducto($intIdproducto);
						if($requestDelete)
						{
							$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
						}else{
							$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			



}
