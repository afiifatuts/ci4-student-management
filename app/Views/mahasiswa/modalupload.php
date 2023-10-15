<!-- Modal -->

<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- fungsi atau helper yang umumnya disediakan oleh framework atau library PHP untuk menghasilkan tag <form> dalam HTML. Dalam hal ini, form akan mengirim data ke rute atau URL yang disebut 'mahasiswa/simpandata'. -->
      <form  method="POST" class="formupload">
      <!-- supaya ada token autentikasi  -->
      <?= csrf_field();?>
      <input type="hidden" name="nobp" value="<?= $nobp?>">
      <div class="modal-body">
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Upload Foto</label>
            <div class="col-sm-4">
              <input type="file" class="form-control" id="foto" name="foto" >
              <div class="invalid-feedback errorfoto">
                
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Ambil Gambar (Webcam)</label>
            <div class="col-sm-6">
            <div id="my_camera">

            </div> 
            <p>
                <button type="button" class="btn btn-sm btn-info" onclick="take_picture()">
                Ambil Gambar
                </button>
              </p>
            </div>
          </div>
          
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Cature</label>
            <div class="col-sm-6" id="results">

            </div>
            <input type="hidden" name="imagecam" class="image-tag">
          </div>

         
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btnupload">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

      </form>
    </div>
  </div>
</div>


<script>
    $(document).ready(function () {
        $('.btnupload').click(function (e) { 
            e.preventDefault();
            
            let form = $('.formupload')[0]

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('mahasiswa/doupload')?>",
                data: data,
                enctype:'multipart/form-data',
                processData:false,
                contentType:false,
                cache:false,
                dataType: "json",
                beforeSend: function (e) {
                  $('.btnupload').prop('disable','disabled');  
                  $('.btnupload').html(`<i class="fa fa-spin fa-spinner"></i>`);  
                },
                complete: function (e) {
                  $('.btnupload').removeAttr('disabled');  
                  $('.btnupload').html('Upload');  
                },
                success: function (response) {
                    if(response.error){
                      
                      if(response.error.foto){
                        $('#foto').addClass('is-invalid')
                        $('.errorfoto').html(response.error.foto)
                      }

                      Swal.fire(
                      'Maaf!',
                      response.error,
                      'error'
                    )
                    }else{
                      Swal.fire(
                      'Berhasil!',
                      response.sukses,
                      'success'
                    )
                      $('#modalupload').modal('hide')
                    }
                },
        error: function (xhr, status, error) {
                // Terjadi kesalahan selama permintaan AJAX
                alert("Terjadi kesalahan dalam permintaan AJAX: " + error+status+error +xhr);
                console.log("Terjadi kesalahan dalam permintaan AJAX: " + error );
            }
            });
        });
    });
</script>

<!-- Untuk menampilkan webcamp  -->
<script>
  Webcam.set({
    width:320,
    height:240,
    image_format:'jpeg',
    jpeg_quality:100
  })
  Webcam.attach('#my_camera')

  function take_picture() { 
    Webcam.snap(function (data_url) { 
      $('.image-tag').val(data_url);

    document.getElementById('results').innerHTML = '<img src="'+data_url+'"/>'
     })
   }
</script>