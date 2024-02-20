<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $jdlapp;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/style.css')?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <link rel="icon" href="<?= base_url('assets/dist/img/ico.png')?>">
</head>
<body class="hold-transition lockscreen bgalt bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header">
                                <h3 class="text-center font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <div id="fus">
                                    <div class="lockscreen-credentials">
                                        <div class="input-group">
                                            <form method="post">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                    <input type="text" id="user" class="form-control" placeholder="Username.." autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputPassword">Password</label>
                                                    <input type="password" id="pw" class="form-control" placeholder="Password..">
                                                </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <button type="button" class="btn btn-primary" onclick="login('p')">Login</button>
                                                </div>
                                            </form>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js')?>"></script>


<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 5000
    });

    <?php if (isset($_SESSION['alert_psn'])): ?>
        Toast.fire({
            type: '<?= $_SESSION['alert_jns']?>',
            html: '<?= $_SESSION['alert_psn']?>'
        });
    <?php endif; ?>

    function login(a){
        var data;

        if (a == 'u'){
            data = {"username": $("#user").val()};
        } else {
            data = {"username": $("#user").val(), "password": $("#pw").val()};
        }

        $.ajax({
            method: 'post',
            data: data,
            url: '<?= base_url('proses/valid')?>'+'/'+a,
            success: (res) => {
                if (a == 'u'){
                    if (res != 'N'){
                        $("#fus").attr("hidden", "hidden");
                        $("#fpw").removeAttr("hidden");
                        $("#nmakun").html(res);
                        $("#pw").focus();
                    } else {
                        Toast.fire({
                            type: "warning",
                            html: "<b>Login GAGAL.!!</b><br>Username yang Anda Masukan tidak Dikenali.!!"
                        });
                    }
                } else {
                    if (res == 'Y'){
                        location.href="./";
                    } else {
                        Toast.fire({
                            type: "warning",
                            html: "<b>Password SALAH.!!</b><br>Password yang Anda Masukan tidak COCOK dengan Username : " + $("#user").val()
                        });
                    }
                }
            },
            error: (res) => {
                Swal.fire('', 'Gagal Memproses Permintaan.!','error');
            }
        });
    }

    var enus = document.getElementById("user");
    var enpw = document.getElementById("pw");
    enus.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            login("u");
        }
    });
    enpw.addEventListener("keyup", function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            login("p");
        }
    });
    $("#user").focus();
</script>
</body>
</html>
