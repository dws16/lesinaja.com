<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= base_url('member/cari_tutor') ?>" method="post">
        <h5 class="mb-4 text-gray-800">Plih Mata Kuliah</h5>
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <select name="mapel" class="form-control">
                        <option value=" ">Mata Kuliah</option>
                        <option value="Matematika 1">Matematika 1</option>
                        <option value="Fisika Dasar">Fisika Dasar</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="container">
                    <button type="submit" name="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </div>
    </form>

    <?php if (empty($list)) { ?>
        <div class="alert alert-danger" role="alert">
            Data not found!
        </div>
    <?php } else { ?>
        <?php foreach ($list as $l) : ?>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow mb-4 border-left-primary">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $l['name']; ?></h6>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img src="<?= base_url('assets/img/profile/') . $l['image']; ?>" class="card-img">
                                </div>
                                <div class="col-lg-4">
                                    <p class="card-text">Jurusan :<?= ' ' . $l['jurusan']; ?></p>
                                    <p class="card-text">Angkatan :<?= ' ' . $l['angkatan']; ?></p>
                                    <p class="card-text">Pengajar :<?= ' ' . $l['matkul']; ?></p>
                                    <p class="card-text">IPK :<?= ' ' . $l['grade']; ?></p>
                                    <p class="card-text">No. Telp :<?= ' ' . $l['phone']; ?></p>
                                    <p class="card-text">Rating :<?= ' ' . $l['rating']; ?></p>
                                </div>
                                <div class="col-lg-5">
                                    <h5 class="text-center"><strong>Pesan Mentor</strong></h5>
                                    <p class="align-text-justify">Cocok dengan mentor ini? Tekan tombol di bawah untuk memesan les dengan mentor ini.</p>
                                    <div class="row text-center">
                                        <div class="col">
                                            <a href="" class="btn btn-warning">Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->