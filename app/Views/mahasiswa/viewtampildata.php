<?= $this->extend('layout/main')?>
<?= $this->extend('layout/menu')?>
<?= $this->section('isi')?>
  <!-- DataTables -->
  <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Required datatable js -->
    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<div class="col-sm-12">
           <div class="page-title-box">
               <h4 class="page-title">Data Mahasiswa</h4>
         </div>
 </div>

 <div class="col-sm-12">
 <div class="card m-b-30">
                            <div class="card-body">
                                <p class="card-text">
                                    <table class="table table-sm table-stripped" id="datamahasiswa">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No BP</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tgl Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $nomor =0; foreach ($dataMhs as $mhs) : $nomor++?>
                                                <tr>
                                                    <td><?= $nomor ?></td>
                                                    <td><?= $mhs['nohp'] ?></td>
                                                    <td><?= $mhs['nama'] ?></td>
                                                    <td><?= $mhs['tmplahir'] ?></td>
                                                    <td><?= $mhs['tgllahir'] ?></td>
                                                    <td><?= $mhs['jenkel'] ?></td>
                                                    <td>

                                                    </td>
                                                    
                                                </tr>
                                                <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </p>
                              
                            </div>
                        </div>
 </div>

 <script>
    $(document).ready(function(){
        $('#datamahasiswa').DataTable();
    });
 </script>
<?= $this->endSection('')?>

