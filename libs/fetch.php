<?php
(!isset($_SESSION))?session_start():"";
include "config.php";

$columns = array('id_prestasi', 'siswa', 'jenis_prestasi', 'daftar_prestasi', 'file_sertifikat', 'jenjang_prestasi');

$query = "SELECT *, jenjang_prestasi.nama as nama_jenjang_prestasi FROM prestasi left join jenjang_prestasi on prestasi.jenjang_prestasi = jenjang_prestasi.id_jenjang_prestasi ";

if(isset($_POST["search"]["value"]) && $_SESSION['user_data']['usergroup'] == 'admin') {
 $query .= '
 WHERE id_prestasi LIKE "%'.$_POST["search"]["value"].'%" 
 OR siswa LIKE "%'.$_POST["search"]["value"].'%" 
 OR nama_siswa LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]) && $_SESSION['user_data']['usergroup'] == 'admin') {
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
} else {
 $query .= 'ORDER BY id_prestasi ASC ';
}

$query1 = '';

if($_POST["length"] != -1) {
 $query1 = 'LIMIT ' . ($_POST['start'] + $_SESSION['user_data']['start']) . ', ' . $_POST['length'];
}

if($_SESSION['user_data']['start'] > -1){
    $limit = " LIMIT ".($_SESSION['user_data']['end'] - $_SESSION['user_data']['start']);
} else {
    $limit = "";
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query . $limit));
$result = mysqli_query($connect, $query . $query1);

$dropdown = mysqli_query($connect, "SELECT * FROM jenjang_prestasi ORDER BY id_jenjang_prestasi");
$dropdown2 = mysqli_query($connect, "SELECT * FROM jenjang_prestasi ORDER BY id_jenjang_prestasi");

$str = '';
while($we=mysqli_fetch_array($dropdown , MYSQLI_NUM)){ $str .= '<option value="'.$we[0].'">'.$we[1].' | '.$we[2].'</option>'; }
$str .= '';

$strd = '';
while($wed=mysqli_fetch_array($dropdown2 , MYSQLI_NUM)){ $strd .= '<option value='.$wed[0].'>'.$wed[1].' | '.$wed[2].'</option>'; }
$strd .= '';


$data = array();

$no = 1 + $_POST['start'];
while($row = mysqli_fetch_array($result)) {
$tes = '<select class="update form-control" data-id='.$row["id_prestasi"].' data-column=jenjang_prestasi><option value=>Pilihan Prestasi</option>'.$strd.'</select>';    
    
 $sub_array = array();
 $sub_array[] = '<div>'.$no.'</div>';
 $sub_array[] = '<div>' . $row["siswa"] .'<br/>'. $row["nama_siswa"] . '</div>';
 $sub_array[] = '<div>' . $row["jenis_prestasi"] . '</div>';
 $sub_array[] = '<div>' . $row["daftar_prestasi"] . '</div>';
 $sub_array[] = '<a href="http://localhost/snmptn2018/data/'.$row["siswa"].'/Prestasi/'.$row["file_sertifikat"].'" data-lightbox="property" data-title=\''.$row["siswa"] .' '. $row["nama_siswa"].'<br/>'.$tes.'\'>'.$row["file_sertifikat"].'</a>';
 $sub_array[] = (($row["flag_ver"]) ? '<div class="alert-success">' : '<div>' ). $row["nama_jenjang_prestasi"] .' - '. $row["urutan"] . '</div>
 <select class="update form-control" data-id="'.$row["id_prestasi"].'" data-column="jenjang_prestasi"><option value="">Pilihan Prestasi</option>'.$str.'</select>';
 $data[] = $sub_array;
 $no++;
}

function get_all_data($connect) {
 $query = "SELECT * FROM prestasi";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>