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
            <h6 class="m-0 font-weight-bold text-primary">User Profile</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                </div>
                <div class="col-lg-8">
                    <p class="card-text">Name :<?= ' ' . $user['name']; ?></p>
                    <p class="card-text">Email :<?= ' ' . $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>
    <?php if ($user['role_id'] == 2) { ?>
        <div class="card shadow mb-4 border-left-warning">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mentor Profile</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="card-text">Jurusan :<?= ' ' . $mentor['jurusan']; ?></p>
                        <p class="card-text">Angkatan :<?= ' ' . $mentor['angkatan']; ?></p>
                        <p class="card-text">Pengajar :<?= ' ' . $mentor['matkul']; ?></p>
                        <p class="card-text">IPK :<?= ' ' . $mentor['grade']; ?></p>
                        <p class="card-text">No. Telp :<?= ' ' . $mentor['phone']; ?></p>
                        <p class="card-text">Alamat :<?= ' ' . $mentor['address']; ?></p>
                        <p class="card-text">Rating :<?= ' ' . $mentor['rating']; ?></p>
                        <p class="card-text">Jumlah mengajar :<?= ' ' . $mentor['teach_sum']; ?></p>
                    </div>
                </div>
                <div class="row mt-2 justify-content-end">
                    <div class="col-lg-2 ml-auto">
                        <a href="<?= base_url('user/editmentor/') . $user['id']; ?>" class="btn btn-primary tampilMentorEdit" data-toggle="modal" data-target="#MentorEdit" data-id="<?= $user['id']; ?>">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>


    <?php } ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="MentorEdit" tabindex="-1" role="dialog" aria-labelledby="MentorEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MentorEditLabel">Edit User Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/editmentor') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input class="form-control" type="text" name="jurusan" id="jurusan">
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input class="form-control" type="text" name="angkatan" id="angkatan">
                    </div>
                    <div class="form-group">
                        <label for="pengajar">Pengajar</label>
                        <input class="form-control" type="text" name="pengajar" id="pengajar">
                    </div>
                    <div class="form-group">
                        <label for="ipk">IPK</label>
                        <input class="form-control" type="text" name="ipk" id="ipk">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" type="text" name="alamat" id="alamat">
                    </div>
                    <div class="form-group">
                        <label for="telp">No. Telp</label>
                        <input class="form-control" type="text" name="telp" id="telp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>