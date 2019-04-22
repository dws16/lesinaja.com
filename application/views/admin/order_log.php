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
                                <th scope="col">Bill</th>
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
                                <th scope="col">Bill</th>
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
                                        <td><?= $l['email']; ?></td>
                                        <td><?= $l['role_id']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/detail/') . $l['id']; ?>" data-toggle="modal" data-target="#UserDetail" data-id="<?= $l['id']; ?>" class="badge badge-pill badge-success tampilModalDetail">
                                                <i class="fas fa-fw fa-info-circle"></i>
                                                Detail
                                            </a>
                                            <a href="<?= base_url('admin/edit/') . $l['id']; ?>" class="badge badge-pill badge-primary tampilModalUbah" data-id="<?= $l['id']; ?>" data-toggle="modal" data-target="#UserEdit">
                                                <i class=" fas fa-fw fa-edit"></i>
                                                Edit
                                            </a>
                                            <a href="<?= base_url('admin/delete/') . $l['id']; ?>" onclick="return confirm('Yakin?');" class="badge badge-pill badge-danger">
                                                <i class="fas fa-fw fa-trash-alt"></i>
                                                Delete
                                            </a>
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