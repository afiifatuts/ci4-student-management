<?= $this->extend('layout/main')?>
<?= $this->extend('layout/menu')?>
<?= $this->section('isi')?>
  <!-- DataTables -->
  <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Required datatable js -->
    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<div class="col-sm-12">
           <div class="page-title-box">
               <h4 class="page-title">Data Mahasiswa</h4>
         </div>
 </div>

 <div class="col-sm-12">
 <div class="card m-b-30">
                            <div class="card-body">
                                <div class="card-title">
                                    <button type="button" class="btn btn-primary btn-sm tomboltambah">
                                    <i class="fa fa-plus-circle mr-1"></i>Tambah Data</button>
                                    <button type="button" class="btn btn-info btn-sm tomboltambahbanyak">
                                    <i class="fa fa-plus-circle mr-1"></i>Tambah Data Banyak</button>
                                </div>

                                <!-- untuk tambah banyak  -->
                                <p class="card-text viewdata">
                                   
                                </p>
                              
      </div>
   </div>
 </div>

 <!-- Untuk menampung modal nya  -->
 <div class="viewmodal" style="display:none;"></div>
 <script>
    function datamahasiswa() {
        $.ajax({
            url: "<?= site_url('mahasiswa/ambildata')?>",
            dataType: "json",
            success: function (response) {
                // console.log(response.data);
                $('.viewdata').html(response.data);
            },
            error: function(xhr, status, error) {
            console.log('An error occurred:', error);
             alert('An error occurred: ' + error);
            }
            
        });
    }
 </script>

 <!-- Ketika page di buka -->
 <script>
    $(document).ready(function(){
        //tampil data mahasiswa
        datamahasiswa();

        // handle tombol tambah
        $('.tomboltambah').click(function (e) {
            e.preventDefault();
            $.ajax({
            url: "<?= site_url('mahasiswa/formtambah')?>",
            dataType: "json",
            success: function (response) {
                $('.viewmodal').html(response.data).show();

            $('#modaltambah').modal('show');
            },
            error: function(xhr, status, error) {
            console.log('An error occurred:', error);
             alert('An error occurred: ' + error);
            }
            
        });
        })
        
        
        // handle tombol tambah banyak
        $('.tomboltambahbanyak').click(function (e) {
            e.preventDefault();
            $.ajax({
            url: "<?= site_url('mahasiswa/formtambahbanyak')?>",
            dataType: "json",
            beforeSend: function () {
                $('.viewdata').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            success: function (response) {
                $('.viewdata').html(response.data).show();
            },
            error: function(xhr, status, error) {
            console.log('An error occurred:', error);
             alert('An error occurred: ' + error);
            }
            
        });
        })

    });
 </script>
<?= $this->endSection('')?>

