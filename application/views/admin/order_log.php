<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Log</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row mx-1">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-1 mt-2">
                                    <label for="show">Show</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="custom-select" name="show" id="show">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-2">Entries</div>
                            </div>
                        </div>
                        <div class="col-md-5 ml-auto">
                            <form action="<?= base_url('admin/user_list') ?>" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="keyword" placeholder="Search order...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-fw fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ORDER-ID</th>
                                <th scope="col">Member</th>
                                <th scope="col">Mentor</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Verified</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ORDER-ID</th>
                                <th scope="col">Member</th>
                                <th scope="col">Mentor</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Verified</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php if (empty($list)) { ?>
                                <tr>
                                    <div class="alert alert-danger" role="alert">
                                        Data not found!
                                    </div>
                                </tr>
                            <?php } else { ?>
                                <?php $i = 1;
                                foreach ($list as $l) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $l['order_id']; ?></td>
                                        <td><?= $l['name']; ?></td>
                                        <td><?php $nama = $this->db->get_where('user', ['id' => $l['mentor_id']])->row_array();
                                            echo $nama['name']; ?></td>
                                        <td><?= $l['bill'] ?></td>
                                        <td><?= $l['is_verified'] ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/order_log/') . $l['order_id']; ?>" class="badge badge-pill badge-primary DetailOrder" data-toggle="modal" data-target="#OrderDetail" data-id="<?= $l['order_id']; ?>">Detail</a>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<div class="modal fade" id="OrderDetail" tabindex="-1" role="dialog" aria-labelledby="OrderDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="OrderDetailLabel">Order Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/verif') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="text" name="email" id="email" readonly>
                                        <input class="form-control" type="text" name="order_id" id="order_id" hidden>
                                        <input class="form-control" type="text" name="mentor_id" id="mentor_id" hidden>
                                        <input class="form-control" type="text" name="member" id="member" hidden>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="address">Alamat</label>
                                        <input type="text" class="form-control" id="address" name="address" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="date">Tanggal</label>
                                        <input type="text" class="form-control" id="date" name="date" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="hour">Jam</label>
                                        <input type="text" class="form-control" id="hour" name="hour" readonly>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="minute">:</label>
                                        <input type="text" class="form-control" id="minute" name="minute" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="timestamp">Waktu Daftar</label>
                                        <input type="text" class="form-control" id="timestamp" name="timestamp" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="note">Catatan</label>
                                        <input type="text" class="form-control" id="note" name="note" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <img id="gambar1" src="" class="card-img">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Verify</button>
                </div>
            </form>
        </div>
    </div>
</div>