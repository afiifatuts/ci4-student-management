<?= $this->extend('layout/main')?>

<?= $this->section('menu')?>
<li class="has-submenu">
      <a href="<?=site_url('layout')?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
 </li>
 <li class="has-submenu">
      <a href="<?=site_url('mahasiswa')?>">Mahasiswa</a>
 </li>
<?= $this->endSection('')?>