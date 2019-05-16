<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success text-center">Form Pemesanan Mentor</h6>
                </div>
                <div class="card-body">
                    <form class="member" action="<?= base_url('member/order') ?>" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="mentor_name">Nama Mentor :</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="mentor_name" name="mentor_name" readonly value="<?= $detail['name']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="matkul">Mata kuliah :</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="matkul" name="matkul" readonly value="<?= $detail['matkul']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="mentor_id" name="mentor_id" value="<?= $detail['id'] ?>">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="date">Pilih Jadwal * :</label>
                                    <?= form_error('date', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-lg-7">
                                    <select class="form-control" name="date" id="date">
                                        <option value="0" selected>Pilih Jadwal</option>
                                        <?php foreach ($jadwal as $j) : ?>
                                            <option value="<?= $j['id']; ?>"><?= $j['date'] . ', Pukul ' . $j['hour'] . ':' . $j['minute']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="address">Alamat pelaksanaan tutor * :</label>
                                    <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-5">
                                    <label for="note">Catatan :</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>
                            </div>
                        </div>
                        <p>* Wajib diisi</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->