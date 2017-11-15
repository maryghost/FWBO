<?php
 header('Access-Control-Allow-Origin: *');  
echo "POST\n";
echo "<pre>" . print_r($_POST, true) . "</pre>";
echo "GET\n";
echo "<pre>" . print_r($_GET, true) . "</pre>";
echo "COOKIES\n";
echo "<pre>" . print_r($_COOKIE, true) . "</pre>";
if ($_FILES) {
echo "<pre>" . print_r($_FILES, true) . "</pre>";

  echo "FILES\n";
  echo <<< TABLE
  <table class="table">
    <tr>
      <th>ID</th><th>Name</th><th>Type</th><th>Size</th>
TABLE;
  foreach($_FILES as $id => $file) {
  if (is_array($file['name'])) {
    foreach($file['name'] as $k => $f) {
    echo <<< ROW
    <tr>
      <td>{$id}[{$k}]</td><td>{$f}</td><td>{$file['type'][$k]}</td><td>{$file['size'][$k]}</td>
    </tr>

ROW;
    }
  }
  else {
    echo <<< ROW
    <tr>
      <td>{$id}</td><td>{$file['name']}</td><td>{$file['type']}</td><td>{$file['size']}</td>
    </tr>

ROW;
    unlink($file['tmp_name']);
  }
  }
}
echo <<< TABLE
  </table>
TABLE;
echo "RAW Input<br/>";
echo urldecode(file_get_contents('php://input'));
echo "End Raw Input<br/>";
//if (!empty($_GET['server'])) {
//  echo "<pre>" . print_r($_SERVER,true). "</pre>";
//}