<?PHP
include '../connection/connection.php';
if (isset($_POST['inputDetPrice'])) {
    $id_det = $_POST['inputDetPrice'];
    fetchDataByID($id_det);
}
function fetchDataByID($id_det)
{
    global $conn;
    $sql = "SELECT kamera.HARGA_SEWA_KAMERA, lensa.HARGA_LENSA FROM kamera INNER JOIN detail_tambahan ON kamera.ID_KAMERA = detail_tambahan.ID_KAMERA INNER JOIN lensa ON detail_tambahan.ID_LENSA = lensa.ID_LENSA WHERE detail_tambahan.ID_DET_TAMBAHAN = '$id_det'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    echo $row[0] + $row[1];
}

if (isset($_POST['inputFacPrice'])) {
    $id_fac = $_POST['inputFacPrice'];
    fetchDataByID2($id_fac);
}
function fetchDataByID2($id_fac)
{
    global $conn;
    $sql = "SELECT fasilitas.HARGA_FASILITAS FROM fasilitas WHERE fasilitas.ID_FASILITAS = '$id_fac'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    echo $row[0];
}