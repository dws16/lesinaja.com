<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Konfirmasi Pembayaran</h6>
                </div>
                <div class="card-body m-5">
                    <?= $this->session->flashdata('message'); ?>
                    <?= form_open_multipart(base_url('member/confirm')); ?>
                    <div class="form-group row">
                        <input type="text" name="order_id" class="form-control" id="order_id" placeholder="Kode Order Anda">
                        <?= form_error('order_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email Anda">
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="custom-file">
                            <input type="file" name="bukti" class="custom-file-input" id="bukti">
                            <label class="custom-file-label" for="bukti">Bukti Pembayaran</label>
                            <?= form_error('bukti', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group mt-5">
                        <div class="row justify-content-center">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary">Konfirmasi Sekarang</button>
                            </div>
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