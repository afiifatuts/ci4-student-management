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

<script>
    $(document).ready(function () {
        $('#datamahasiswa').DataTable();
    });
</script>