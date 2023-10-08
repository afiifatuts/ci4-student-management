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
                                <div class="card-title">
                                    <button type="button" class="btn btn-primary btn-sm tomboltambah">
                                        <i class="fa fa-plus-circle mr-1"></i>Tambah Data</button>
                                </div>
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
                $('.viewdata').html(response.data);
            },
            error: function(xhr, status, error) {
            console.log('An error occurred:', error);
             alert('An error occurred: ' + error);
            }
            
        });
    }
 </script>
 <script>
    $(document).ready(function(){
        datamahasiswa();

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
        // $('#datamahasiswa').DataTable();
    });
 </script>
<?= $this->endSection('')?>

