<?php
	include_once('../includes/variables.php');
	include_once('../includes/crud.php');
    $db = new Database();
    $db->connect();
    date_default_timezone_set('Asia/Kolkata');
    
  	/* accesskey:90336
  	 product_id:230 */
 
	
	if(isset($_POST['accesskey']) && isset($_POST['product_id'])) {
		$access_key_received = $_POST['accesskey'];
		$product_id = $db->escapeString($_POST['product_id']);
		
		if($access_key_received == $access_key){

			if(!empty($product_id)){ 
                    $sql="SELECT * FROM products WHERE id = '".$product_id."' ";
         
                }else{
                    // $sql="SELECT *,(SELECT MIN(price) FROM product_variant pv WHERE pv.product_id=p.id) as price FROM products p ".$sort."";
                    $sql = "SELECT * FROM products";
                 
                }
                
            $db->sql($sql);
            $res = $db->getResult();
            // return $res;
            $product = array();
            $i = 0;
            foreach($res as $row){
                
                $sql = "SELECT *,(SELECT short_code FROM unit u WHERE u.id=pv.measurement_unit_id) as measurement_unit_name,(SELECT short_code FROM unit u WHERE u.id=pv.stock_unit_id) as stock_unit_name FROM product_variant pv WHERE pv.product_id=".$row['id']." ";
                $db->sql($sql);
                
                $row['other_images'] = json_decode($row['other_images'],1);
                $row['other_images'] = (empty($row['other_images']))?array():$row['other_images'];
                for($j=0;$j<count($row['other_images']);$j++){
                    $row['other_images'][$j] = DOMAIN_URL.$row['other_images'][$j];
                }
                
                $row['image'] = DOMAIN_URL.$row['image'];
                $product[$i] = $row;
                $product[$i]['variants'] = $db->getResult();
                $i++;
            }
		    
			// create json output
			if(!empty($product)){
			    $output = json_encode(array('error' => false,
			    'data' => $product));
			}else{
			    $output = json_encode(array('error' => true,
			    'data' => 'No products available'));
			}
		}else{
			die('accesskey is incorrect.');
		}
	} else {
		die('accesskey and product id are required.');
	}
 
	//Output the output.
	echo $output;

	$db->disconnect(); 
	//to check if the string is json or not
	function isJSON($string){
		return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
	}
?>