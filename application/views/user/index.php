<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="col">
        <div class="row-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card shadow mb-4 border-left-primary">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $user['name']; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                </div>
                <div class="col-lg-8">
                    <p class="card-text">Email :<?= ' ' . $user['email']; ?></p>
                    <?php if ($user['role_id'] == 2) { ?>
                        <p class="card-text">Jurusan :<?= ' ' . $mentor['jurusan']; ?></p>
                        <p class="card-text">Angkatan :<?= ' ' . $mentor['angkatan']; ?></p>
                        <p class="card-text">Pengajar :<?= ' ' . $mentor['matkul']; ?></p>
                        <p class="card-text">IPK :<?= ' ' . $mentor['grade']; ?></p>
                        <p class="card-text">No. Telp :<?= ' ' . $mentor['phone']; ?></p>
                        <p class="card-text">Alamat :<?= ' ' . $mentor['address']; ?></p>
                        <p class="card-text">Rating :<?= ' ' . $mentor['rating']; ?></p>
                        <p class="card-text">Jumlah mengajar :<?= ' ' . $mentor['teach_sum']; ?></p>
                    <?php } ?>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->