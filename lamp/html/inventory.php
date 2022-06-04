<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://192.168.236.128:3000/showinventory");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = json_decode(curl_exec($ch), true);
curl_close($ch);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="home.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="fluid-container">
                            <h1 class="" style="margin-left: 0px;">Data Barang</h1>
                            <button type="button" style="font-size:1rem;margin:10px 0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
                                Tambah Produk
                            </button>
                            <div class="">
                                <hr style="width:700px;">
                                <div class="" style="display:flex;justify-content:center">
                                    <table  id="tabelProduk" class="tableDataProduk">
                                        <tr>
                                            <th style="width: 20px;">
                                                NO
                                            </th>
                                            <th>
                                                Nama Barang
                                            </th>
                                            <th>
                                                Jumlah Barang
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        <?php foreach ($result['result'] as $key => $value) { 
                                            ?>
                                            <tr>
                                                <td style="width: 20px;">
                                                    <?php echo (int)$key + 1 ?>
                                                </td>
                                                <td>
                                                    <?php echo $value['name'] ?>
                                                </td>
                                                <td>
                                                    <div style="display:flex;justify-content:center;">
                                                        <?php echo $value['stock']  ?>
                                                    </div>
                                                </td>
                                                <td style="display:flex;justify-content:center;">
                                                    <form action="/delete.php" method='POST' style="margin: 0px;">
                                                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                        <button href="" type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal addData -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" action="/add-data.php" method="post" runat="server" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Barang</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Input Nama Barang">
                        </div>
                        <div id="inputBnykBarang" class="mb-3">
                            <label for="item_count" class="form-label">Banyak Barang</label>
                            <input type="number" name="stock" class="form-control" id="stock" placeholder="Input Banyak Barang">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>