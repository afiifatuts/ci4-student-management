<!-- Modal -->

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- fungsi atau helper yang umumnya disediakan oleh framework atau library PHP untuk menghasilkan tag <form> dalam HTML. Dalam hal ini, form akan mengirim data ke rute atau URL yang disebut 'mahasiswa/simpandata'. -->
      <form action="<?= site_url('mahasiswa/updatedata') ?>" method="POST" class="formmahasiswa">
      <!-- supaya ada token autentikasi  -->
      <?= csrf_field();?>
      <div class="modal-body">
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">No.BP</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="nobp" name="nobp" value="<?= $nobp ?>" readonly>
              
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nama" name="nama"  value="<?= $nama ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Tempat Lahir</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $tempat ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Tgl. Lahir</label>
            <div class="col-sm-6">
              <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $tanggal ?>" >
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-6">
              <select name="jenkel" id="jenkel" class="form-control">
                <option value="">Pilih</option>
                <option value="L" <?php if($jenkel =='L') echo "selected";?>>Laki-Laki</option>
                <option value="P" <?php if($jenkel =='P') echo "selected";?>>Perempuan</option>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnsimpan">Update </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('.formmahasiswa').submit(function (e) { 
        e.preventDefault();
        var form = $(this); // Simpan referensi ke formulir dalam variabel 'form'
        $.ajax({
            type: "post",
            url: form.attr('action'), // Menggunakan form.attr() untuk mendapatkan URL action
            data: form.serialize(), // Menggunakan form.serialize() untuk mengambil data formulir
            dataType: "json",
            beforeSend: function () { 
                $('.btnsimpan').attr('disabled', 'disabled'); // Perbaiki 'disable' menjadi 'disabled'
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function () {
                $('.btnsimpan').removeAttr('disabled'); // Perbaiki 'disable' menjadi 'disabled'
                $('.btnsimpan').html('Update');
            },
            success: function (response) {
                
                  // alert(response.sukses)
                  Swal.fire({
                    "icon":'success',
                    "title":'Berhasil',
                    "text":response.sukses,
                  })
                  $('#modaledit').modal('hide');
                  datamahasiswa();
                
            },
            error: function (xhr, status, error) {
                // Terjadi kesalahan selama permintaan AJAX
                alert("Terjadi kesalahan dalam permintaan AJAX: " + error);
            }
        });
    });
});

</script>