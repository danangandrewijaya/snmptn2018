<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "snmptn-verifikasi");
$columns = array('id_prestasi', 'siswa', 'jenis_prestasi', 'daftar_prestasi', 'file_sertifikat', 'jenjang_prestasi');

$query = "SELECT *, jenjang_prestasi.nama as nama_jenjang_prestasi FROM prestasi left join jenjang_prestasi on prestasi.nilai_prestasi = jenjang_prestasi.id_jenjang_prestasi ";

if(isset($_POST["search"]["value"])) {
 $query .= '
 WHERE id_prestasi LIKE "%'.$_POST["search"]["value"].'%" 
 OR siswa LIKE "%'.$_POST["search"]["value"].'%" 
 OR nama_siswa LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"])) {
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
} else {
 $query .= 'ORDER BY id_prestasi ASC ';
}

$query1 = '';

if($_POST["length"] != -1) {
 $query1 = 'LIMIT ' . ($_POST['start']) . ', ' . $_POST['length'];
}

$limit = "";
$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query . $limit));

$result = mysqli_query($connect, $query . $query1);
$dropdown = mysqli_query($connect, "SELECT * FROM jenjang_prestasi ORDER BY id_jenjang_prestasi");

$str = '';
while($we=mysqli_fetch_array($dropdown)){ $str .= '<option value="'.$we["id_jenjang_prestasi"].'">'.$we["nama"].' | '.$we["urutan"].'</option>'; }


$data = array();

while($row = mysqli_fetch_array($result)) {
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["id_prestasi"].'" data-column="id_prestasi">' . $row["id_prestasi"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["id_prestasi"].'" data-column="siswa">' . $row["siswa"] .'<br/>'. $row["nama_siswa"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["id_prestasi"].'" data-column="jenis_prestasi">' . $row["jenis_prestasi"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["id_prestasi"].'" data-column="daftar_prestasi">' . $row["daftar_prestasi"] . '</div>';
 $sub_array[] = '<a data-id="'.$row["id_prestasi"].'" data-column="file_sertifikat" href="http://localhost/snmptn2018/data/'.$row["siswa"].'/Prestasi/'.$row["file_sertifikat"].'" data-lightbox="property"><img width="150px" src="http://localhost/snmptn2018/data/'.$row["siswa"].'/Prestasi/'.$row["file_sertifikat"].'" alt="'.$row["file_sertifikat"].'"></a>';
 $sub_array[] = (($row["flag_ver"]) ? '<div class="alert-success">' : '<div>' ). $row["nama_jenjang_prestasi"] .' - '. $row["urutan"] . '</div>
 <select class="update form-control" data-id="'.$row["id_prestasi"].'" data-column="nilai_prestasi"><option value="">Pilihan Prestasi</option>'.$str.'</select>';
 $data[] = $sub_array;
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