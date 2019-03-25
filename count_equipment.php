<?php
include '../config/connect_DB.php';
header("Access-Control-Allow-Origin: *");
$data = file_get_contents("php://input");
$_POST = json_decode($data,true);

   $month['data_month'] = array (
            
            ["num_month"=>'01',"month"=>'มกราคม'],
            ["num_month"=>'02',"month"=>'กุมภาพันธ์'],
            ["num_month"=>'03',"month"=>'มีนาคม'],
            ["num_month"=>'04',"month"=>'เมษายน'],
            ["num_month"=>'05',"month"=>'พฤษภาคม '],
            ["num_month"=>'06',"month"=>'มิถุนายน'],
            ["num_month"=>'07',"month"=>'กรกฎาคม'],
            ["num_month"=>'08',"month"=>'สิงหาคม'],
            ["num_month"=>'09',"month"=>'กันยายน'],
            ["num_month"=>'10',"month"=>'ตุลาคม'],
            ["num_month"=>'11',"month"=>'พฤศจิกายน'],
            ["num_month"=>'12',"month"=>'ธันวาคม'],
            );

if(isset($_POST['date_service'])){
    $ref_id_tec = $_POST['ref_id_tec'];
    $date_service = $_POST['date_service'];
    $count_equipment = $_POST['count_equipment'];
}
$array_usesed = [];
foreach ($month['data_month'] as $key => $data_month) {
   
$sql = "SELECT COUNT(*) as list_equipment 
FROM `customerforrent` 
WHERE
`equipment` LIKE'{$count_equipment}%'
AND
`date of service` LIKE'{$date_service}-{$data_month["num_month"]}%'
AND 
`ref_id_tec` = '{$ref_id_tec}'" ;

    
    if($res = mysqli_query($connection,$sql)){
        $row = mysqli_fetch_assoc($res);
        $array_usesed[] = $row["list_equipment"]*1;
    }
}

    echo json_encode($array_usesed);

?>