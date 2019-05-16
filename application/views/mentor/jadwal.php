<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card shadow mb-4 border-left-primary">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-10">
                            <h6 class="font-weight-bold text-primary mt-2">Jadwal Kosong Saya</h6>
                        </div>
                        <div class="col-lg-2 justify-content-end">
                            <a href="" class="btn btn-success" data-toggle="modal" data-target="#NewScheduleModal">Isi Jadwal Saya</a>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($jadwal as $j) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $j['date']; ?></td>
                                        <td><?= $j['hour'] . ':' . $j['minute']; ?></td>
                                        <td>
                                            <a href="<?= base_url('mentor/deleteschedule/') . $j['id']; ?>" class="badge badge-pill badge-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card shadow mb-4 border-left-danger">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold text-primary mt-2">Jadwal Mengajar Saya</h6>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($schedule as $j) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?php $nama = $this->db->get_where('user', ['email' => $j['email']])->row_array();
                                            echo $nama['name']; ?></td>
                                        <td><?php $date =  $this->db->get_where('mentor_schedule', ['id' => $j['date']])->row_array();
                                            echo $date['date'] . ", Pukul " . $date['hour'] . ":" . $date["minute"];    ?></td>
                                        <td><?= $j['address']; ?></td>
                                        <td><?= $j['note']; ?></td>
                                    </tr>
                                    <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="NewScheduleModal" tabindex="-1" role="dialog" aria-labelledby="NewScheduleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewScheduleModalLabel">Add New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="mentor" action="<?= base_url('mentor/addschedule') ?>" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="hidden" id="mentor_id" name="mentor_id" value="<?= $this->session->userdata('id'); ?>">
                                <label for="date">Tanggal</label>
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="time">Pukul</label>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control" name="hour" id="hour">
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" name="minute" id="minute">
                                            <option value="00">00</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>