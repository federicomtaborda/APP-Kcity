<?php 

	class Proveedores extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

        public function proveedores()
		{
			$data['page_id'] = 2;
			$data['page_home'] = "Inicio";
			$data['page_name'] = "Proveedores";
			$data['page_functions_js'] = "proveedores.js";
			$this->views->getView($this,"proveedores",$data);
		}

		public function getSelectProveedores(){
			$htmlOptions = "";
			$arrData = $this->model->selectProveedor();
			if(count($arrData) > 0 ){
				for ($i=0; $i < count($arrData); $i++) { 
					if($arrData[$i]['estado'] == 1 ){
					$htmlOptions .= '<option value="'.$arrData[$i]['id_proveedor'].'">'.$arrData[$i]['proveedor'].'</option>';
					}
				}
			}
			echo $htmlOptions;
			die();	
		}

		/**** LISTADO DE PROVEEDORES ****/
		public function getProveedores(){

			$arrData = $this->model->getProveedores();

			$btnEdit = '';
			$btnDelete ='';
			
			for ($i=0; $i < count($arrData); $i++) {
		
				$btnEdit = '<button type="button" class="btn btn-outline-secondary btn-xs" 
				onClick="editProveedor('.$arrData[$i]['id_proveedor'].')" title="editar proveedor">
								<i class="fas fa-pencil-alt"></i>
							</button>';

				$btnDelete = '<button type="button" class="btn btn-outline-secondary btn-xs" 
							onClick="deleteProveedor('.$arrData[$i]['id_proveedor'].')" title="eliminar proveedor">
								<i class="fas fa-trash-alt"></i>
						</button>';

				if($arrData[$i]['estado'] == 1){
					$arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
				}		
				$arrData[$i]['options'] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';	

			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}

		/**** PROVEEDOR POR ID ****/
		function getProveedor($id_proveedor){
			$idproveedor= intval($id_proveedor);
			if($idproveedor > 0){
				$arrData = $this->model->getProveedor($idproveedor);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}			

		}

		/**** ELIMIMA UUN PROVEEDOR ****/
		public function deleteProveedor(){
			if($_POST){
					$intproveedor = intval($_POST['idproveedor']);
					$requestDelete = $this->model->deleteProveedor($intproveedor);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la actegoria');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la actegoria.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		
		/************************* GUARDAR UN PROVEEDOR ******************************/
		public function setProveedores(){
				if($_POST){
			
					if(empty($_POST['proveedor']) || empty($_POST['estado']))
					{
						$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					}else{
						
						$idproveedor = intval($_POST['id_proveedor']);
						$proveedor = strClean($_POST['proveedor']);
						$descripcion = strClean($_POST['descripcion']);
						$estado = intval($_POST['estado']);
	
						if($idproveedor == 0)
						{	
	
							$request_proveedor = $this->model->insertproveedor($proveedor,
																		$descripcion, 
																		$estado);
							$option = 1;
						}else{
	
							$request_proveedor = $this->model->updateProveedor($idproveedor,
																		$proveedor,
																		$descripcion, 
																		$estado);
							$option = 2;
						}
	
						if($request_proveedor > 0 )
						{
							if($option == 1){
								$arrResponse = array('status' => true, 'data' => $request_proveedor, 'msg' => 'Datos guardados correctamente.');
							}else{
								$arrResponse = array('status' => true, 'data' => $request_proveedor, 'msg' => 'Datos Actualizados correctamente.');
							}
						}else if($request_proveedor == 'exist'){
							$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe el proveedor en el sistema');		
						}else{
							$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
						}
						echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
					}	
				}
			}

	}