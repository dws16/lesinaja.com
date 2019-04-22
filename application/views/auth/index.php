<body class="bg-gradient">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-default">

        <div class="container">

            <a class="navbar-brand" href="<?= base_url('') ?>">
                <i class="fa fa-book rotate-n-15"></i>
                LESINAJA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <?php if (!$this->session->userdata('email')) { ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('auth/registration') ?>">Register</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('user') ?>">Dashboard</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>

    <!-- JS BUAT NGESCROLL -->
    <script>
        $(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 300);
        });
    </script>
    <!-- NAVBAR END -->

    <!-- JUMBOTRON -->
    <div class="jumbotron" style="background-color:#70B9B0; background-image:url(./assets/img/book-in-library.jpg); background-repeat:no-repeat; background-size:cover; background-position:70%">
        <div class="row">
            <div class="col-lg-7">
            </div>
            <div class="col-lg-5">
                <div class="container text-center text-light my-5 py-4" style="background:rgba(0, 0, 0, 0.6); background-position:center right; margin-right:-32px !important;">
                    <h2 class="display-10">Selamat datang di</h2>
                    <h1 class="display-4">LESINAJA</h1>
                    <p>Portal pencarian jasa tutor privat online</p>
                </div>
            </div>
        </div>
    </div>
    <!-- JUMBOTRON END -->

    <!-- KELEBIHAN PRODUK -->
    <div class="container mb-5">
        <center>
            <h2 class="mb-5">Mengapa harus Lesinaja ?</h2>
        </center>
        <div class="row mb-4">
            <div class="col-lg-3 align-center">
                <center><i class="far fa-thumbs-up fa-5x mb-4"></i></center>
                <h5 class="text-center">Pengajar Berpengalaman</h4>
                    <p>Pengajar terbukti mampu menyampaikan materi mata kuliah dasar dengan sangat baik serta didukung dengan pengalaman mengajar lebih dari 1 tahun.
                    </p>
            </div>

            <div class="col-lg-3">
                <div class="align-center">
                    <center><i class="far fa-money-bill-alt fa-5x mb-4"></i></center>
                    <h5 class="text-center">Harga Bersaing</h5>
                    <p>Harga yang ditawarkan sebanding dengan fasilitas yang didapatkan.
                    </p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="align-center">
                    <center><i class="fas fa-search-location fa-5x mb-4"></i></center>
                    <h5 class="text-center">Lokasi Fleksibel</h5>
                    <p>Member dapat menentukan lokasi les sesuai keinginan dan keputusan kedua belah pihak.
                    </p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="align-center">
                    <center><i class="fas fa-user-graduate fa-5x mb-4"></i></center>
                    <h5 class="text-center">Jaminan Nilai A</h5>
                    <p>Dapatkan nilai A dengan mudah dengan mengikuti seluruh materi dari pengajar.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- KELEBIHAN PRODUK END -->

    <!-- HUBUNGI KAMI -->
    <div style="background-color:#CDDDDD;" class="py-5">
        <div class="container">
            <h4 class="text-center text-dark mb-4">Hubungi Kami</h4>
            <form>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name..">
                        </div>
                        <div class="col-lg-6">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email..">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="msg" class="form-control" id="msg" rows="5" placeholder="Write your message here"></textarea>
                </div>
                <div class="row justify-content-center">
                    <div class="col-3-auto">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- HUBUNGI KAMI END -->

    <!-- TOMBOL TOP -->
    <div>
        <style>
            #myBtn {
                display: none;
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 99;
                font-size: 18px;
                border: none;
                outline: none;
                background-color: gray;
                color: white;
                cursor: pointer;
                padding: 15px;
                border-radius: 4px;
            }

            #myBtn:hover {
                background-color: #555;
            }
        </style>
        <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-fw fa-arrow-up"></i></button>
        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("myBtn").style.display = "block";
                } else {
                    document.getElementById("myBtn").style.display = "none";
                }
            }
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
    </div>
    <!-- TOMBOL TOP END -->

    <!-- FOOTER -->
    <div class="px-5" style="background-color:#293132">
        <div class="container">
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-light">
                        <span>Copyright &copy; Kelompok 1 Technopreneur Kelas 1 <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- FOOTER END -->