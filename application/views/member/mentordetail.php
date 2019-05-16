<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $detail['name']; ?></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="<?= base_url('assets/img/profile/') . $detail['image']; ?>" class="card-img">
                        </div>
                        <div class="col-lg-4">
                            <p class="card-text">Jurusan :<?= ' ' . $detail['jurusan']; ?></p>
                            <p class="card-text">Angkatan :<?= ' ' . $detail['angkatan']; ?></p>
                            <p class="card-text">Pengajar :<?= ' ' . $detail['matkul']; ?></p>
                            <p class="card-text">IPK :<?= ' ' . $detail['grade']; ?></p>
                            <p class="card-text">No. Telp :<?= ' ' . $detail['phone']; ?></p>
                        </div>
                    </div>
                    <div class="row mt-5 ml-3">
                        <h4>Jadwal Mengajar</h4>
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($jadwal as $j) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $j['date']; ?></td>
                                        <td><?= $j['hour'] . ':' . $j['minute']; ?></td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-5 ml-3">
                        <div class="col">
                            <div class="row">
                                <h4>Rating</h4>
                            </div>
                            <div class="row">
                                <p>Belum ada rating</p>
                            </div>
                        </div>

                        <?php foreach ($rating as $r) : ?>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="card shadow mb-4 border-left-warning">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-warning text-center"><strong>Pesan Mentor</strong></h6>
                    </div>
                    <div class="card-body">
                        <p class="align-text-justify">Cocok dengan mentor ini? Tekan tombol di bawah untuk memesan les dengan mentor ini.</p>
                        <div class="row text-center">
                            <div class="col">
                                <a href="<?php
                                            if ($jadwal != NULL) {
                                                echo base_url('member/order/') . $detail['id'];
                                            } else {
                                                echo base_url('member/mentordetail/') . $detail['id'];
                                            } ?>" class="btn btn-warning">Pesan</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 justify-content-center">
                    <div class="card shadow mb-4 border-left-danger">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger text-center"><strong>Ada Kesulitan?</strong></h6>
                        </div>
                        <div class="card-body text-center">
                            <p>Hubungi CS kami: <br><br><strong> Firdaus Nanda </strong><br>081937733631</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->