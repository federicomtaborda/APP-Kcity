<?php 

	class Categorias extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

        public function categorias()
		{
			$data['page_id'] = 2;
			$data['page_home'] = "Inicio";
			$data['page_name'] = "Listado de Categorias";
			$data['page_functions_js'] = "categorias.js";
			$this->views->getView($this,"categorias",$data);
		}

		/**** LISTADO DE CATEGORIAS ****/
		public function getCategorias(){

				$arrData = $this->model->getCategorias();

				$btnView =''; 
				$btnEdit = '';
				$btnDelete ='';
				
				for ($i=0; $i < count($arrData); $i++) {
			
					$btnEdit = '<button type="button" class="btn btn-outline-secondary btn-xs" 
					onClick="editCategoria('.$arrData[$i]['id_categoria'].')" title="editar categoria">
									<i class="fas fa-pencil-alt"></i>
								</button>';

					$btnDelete = '<button type="button" class="btn btn-outline-secondary btn-xs" 
								onClick="deleteCategoria('.$arrData[$i]['id_categoria'].')" title="eliminar categoria">
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

			public function getSelectCategorias(){
				$htmlOptions = "";
				$arrData = $this->model->selectCategorias();
				if(count($arrData) > 0 ){
					for ($i=0; $i < count($arrData); $i++) { 
						if($arrData[$i]['estado'] == 1 ){
						$htmlOptions .= '<option value="'.$arrData[$i]['id_categoria'].'">'.$arrData[$i]['categoria'].'</option>';
						}
					}
				}
				echo $htmlOptions;
				die();	
			}


			function getCategoria($id_categoria){

				$idcategoria = intval($id_categoria);
				if($id_categoria > 0){
					$arrData = $this->model->selectCategoria($idcategoria);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}			

			}

			/************************* GUARDAR UNA CATEGORIA ******************************/
		public function setCategoria(){
			if($_POST){

				if(empty($_POST['categoria']) || empty($_POST['estado']))
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}else{
					$idcategoria = intval($_POST['id_categoria']);
					$categoria = strClean($_POST['categoria']);
					$descripcion = strClean($_POST['descripcion']);
					$estado = intval($_POST['estado']);
					if($idcategoria == 0)
					{	

						$request_categoria = $this->model->insertCategoria($categoria,
																	$descripcion, 
																	$estado);
						$option = 1;
					}else{

						$request_categoria = $this->model->updatecategoria($idcategoria,
																	$categoria,
																	$descripcion, 
																	$estado);
						$option = 2;
					}

					if($request_categoria > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'data' => $request_categoria, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'data' => $request_categoria, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_categoria == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe una categoria con el Código Ingresado.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}	
			}
		}


		public function deleteCategoria(){
			if($_POST){
					$intCategoria = intval($_POST['idCategoria']);
					$requestDelete = $this->model->deleteCategoria($intCategoria);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la actegoria');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la actegoria.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
			

		
	}