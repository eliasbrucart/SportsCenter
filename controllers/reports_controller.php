<?php 

class ReportsController{
    public function DownloadReport(){
        if(isset($_GET["report"])){

            $table = $_GET["report"];

            $report = UsersModel::ShowCustomers($table);

            $name = $_GET["report"].'.xls';

            header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$name.'"');
			header("Content-Transfer-Encoding: binary");

            if($_GET["report"] == "customers"){	

				echo utf8_decode("

					<table border='0'>

							<tr> 
						
								<th style='font-weight:bold; border:1px solid #eee;'>Nombre</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Apellido</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Documento</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Actividades</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Estado</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Monto</th>
								<th style='font-weight:bold; border:1px solid #eee;'>Vencimiento</th>	

							</tr>"
						);

						

				foreach ($report as $key => $value) {

					$activitiesArr = json_decode($value["activity"], true);
                    $daysArr = json_decode($value["daysOfActivity"], true);

    				$activitiesCustomer = "";

                    $activitiesAux = array();

					if(is_array($activitiesArr) && is_array($daysArr)){
                        for($j = 0; $j < count($activitiesArr); $j++){
                            array_push($activitiesAux, $activitiesArr[$j]);
                            array_push($activitiesAux, $daysArr[$j]);
                            $activitiesCustomer = implode(", ", $activitiesAux);
                        }
                    }

						echo utf8_decode("

							<tr>
								<td style='border:1px solid #eee;'>".$value["name"]."</td>
								<td style='border:1px solid #eee;'>".$value["lastname"]."</td>
								<td style='border:1px solid #eee;'>$ ".$value["documentNumber"]."</td>
								<td style='border:1px solid #eee;'>".$activitiesCustomer ."</td>
								<td style='border:1px solid #eee;'>".$value["state"]."</td>
								<td style='border:1px solid #eee;'>".$value["amount"]."</td>
								<td style='border:1px solid #eee;'>".$value["expiration"]."</td>
							</tr>

						");
					

				}


				echo utf8_decode("</table>

					");

			}

        }
    }
}


?>