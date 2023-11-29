<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  method="POST">
    <label>DNI</label>
    <input type="text" name="DNI">

    <button type="submit">Envíe su mensaje</button>
  </form>
 <h3>Estos son los datos: </h2>
  <?php
  
  $token = 'apis-token-6613.scd0AQMOfh6McIXXDbuoExxz0NaZiJGT';
    $dni = $_POST['DNI'];
    //$dni = '46027897';

// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  // para user api versión 2
   CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
  // para user api versión 1
  // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));
$response = curl_exec($curl);

curl_close($curl);

$persona = json_decode($response);
//var_dump($response);
// Datos listos para usar
//header("Location: index.php");
//exit;

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($persona)) {
  ?>
  <div>
    <label>Nombres:</label>
    <input type="text" value="<?= $persona->nombres ?>" readonly>
    <br>
    <label>Apellido Paterno:</label>
    <input type="text" value="<?= $persona->apellidoPaterno ?>" readonly>
    <br>
    <label>Apellido Materno:</label>
    <input type="text" value="<?= $persona->apellidoMaterno ?>" readonly>
    <br>
    <label>Tipo de Documento:</label>
    <input type="text" value="<?= $persona->tipoDocumento ?>" readonly>
    <br>
    <label>Número de Documento:</label>
    <input type="text" value="<?= $persona->numeroDocumento ?>" readonly>
  </div>
  <?php
  }
  ?>

</body>
</html>
