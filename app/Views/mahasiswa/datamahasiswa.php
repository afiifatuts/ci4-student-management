<?= form_open('mahasiswa/hapusbanyak',['class'=>'formhapusbanyak'])?>

<p>
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash-o"></i> Hapus Banyak
    </button>
</p>
<table class="table table-sm table-stripped" id="datamahasiswa">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox"  id="centangSemua">
                                                </th>
                                                <th>No</th>
                                                <th>No BP</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tgl Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Prodi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                      
                                    </tbody>
                                    </table>
                                     <!-- Untuk menampung modal nya  -->
 <!-- <div class="viewmodal" style="display:none;"></div> -->
 <?= form_close();?>
 <!-- Fungsi menampilkan datatble  -->
<script>
    function listdatamahasiswa() {
        //serverside datatable
        var table = $('#datamahasiswa').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                "url":"<?= site_url('mahasiswa/listdata')?>",
                "type":"POST",
            },

            "columnDefs":[{
                "targets":0,
                "orderable":false,
            },{
                "targets":1,
                "orderable":false,
            }]
        })
      }
</script>

<script>
    $(document).ready(function () {
        // menampilkan datatable 
        // $('#datamahasiswa').DataTable();
        
        listdatamahasiswa();
        // mencentang smua checkbox 
        $(`#centangSemua`).click(function (e) { 

            if($(this).is(":checked")){
                $('.centangNobp').prop('checked',true);
            }else{
                $('.centangNobp').prop('checked',false);

            }
         })

         //handlesubmit
         $('.formhapusbanyak').submit(function (e) { 
            e.preventDefault();

            let jmldata = $('.centangNobp:checked');

            if(jmldata.length == 0 ){
                Swal.fire({
                    icon:'error',
                    title:'Perhatian',
                    text:'Maaf silahkan pilih data yang mau dihapus',
                });
            }else{
                Swal.fire({
                title: 'Hapus Data Banyak',
                text: `Yakin data mahasiswa dihapus sebanyak ${jmldata.length} data?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (response) {
                            if (response.sukses){
                                Swal.fire({
                                    icon:'success',
                                    title:'Berhasil',
                                    text:response.sukses,
                                });
                                datamahasiswa();
                            }
                        }
                    });    
                }
                })
            }
            // end else 



          })
    
    
    
    });
</script>

<!-- fungsi edit  -->
<script>
function edit(nobp) {
    $.ajax({
        type: "post",
        url: "<?= site_url('mahasiswa/formedit')?>",
        data: {
            nobp : nobp
        },
        dataType: "json",
        success: function (response) {
            if(response.sukses){
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },
        error: function (xhr, status, error) {
                // Terjadi kesalahan selama permintaan AJAX
                alert("Terjadi kesalahan dalam permintaan AJAX: " + error );
            }
    });
}
</script>

<!-- fungsi hapus  -->
<script>
    function hapus(nobp) {
        Swal.fire({
        title: 'Hapus',
        text: `Yakin menghapus data mahasiswa ini dengan nobp ${nobp} ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
            
            $.ajax({
            type: "post",
            url: "<?= site_url('mahasiswa/hapus')?>",
            data: {
                nobp : nobp
            },
            dataType: "json",
            success: function (response) {
                Swal.fire({
                    icon:'success',
                    title:'Berhasil',
                    text: response.sukses,
                })
                datamahasiswa();
            },
            error: function (xhr, status, error) {
                    // Terjadi kesalahan selama permintaan AJAX
                    alert("Terjadi kesalahan dalam permintaan AJAX: " + error );
                }
        });
    }
    })
        
    }
</script>

<!-- upload image  -->
<script>
    function upload(nobp){
        $.ajax({
        type: "post",
        url: "<?= site_url('mahasiswa/formupload')?>",
        data: {
            nobp : nobp
        },
        dataType: "json",
        success: function (response) {
            if(response.sukses){
                $('.viewmodal').html(response.sukses).show();
                $('#modalupload').modal('show');
            }
        },
        error: function (xhr, status, error) {
                // Terjadi kesalahan selama permintaan AJAX
                alert("Terjadi kesalahan dalam permintaan AJAX: " + error+status+error +xhr);
                console.log("Terjadi kesalahan dalam permintaan AJAX: " + error );
            }
    });
    }
</script>