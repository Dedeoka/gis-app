<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <style>
        body{color: #000;overflow-x: hidden;height: 100%;background-image: url("https://i.imgur.com/GMmCQHC.png");background-repeat: no-repeat;background-size: 100% 100%}.card{padding: 30px 40px;margin-top: 60px;margin-bottom: 60px;border: none !important;box-shadow: 0 6px 12px 0 rgba(0,0,0,0.2)}.blue-text{color: #00BCD4}.form-control-label{margin-bottom: 0}input, textarea, button{padding: 8px 15px;border-radius: 5px !important;margin: 5px 0px;box-sizing: border-box;border: 1px solid #ccc;font-size: 18px !important;font-weight: 300}input:focus, textarea:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;border: 1px solid #00BCD4;outline-width: 0;font-weight: 400}.btn-block{text-transform: uppercase;font-size: 15px !important;font-weight: 400;height: 43px;cursor: pointer}.btn-block:hover{color: #fff !important}button:focus{-moz-box-shadow: none !important;-webkit-box-shadow: none !important;box-shadow: none !important;outline-width: 0}
    </style>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Tambah Data Lab</h3>
            <div class="card">
                <h5 class="text-center mb-4">Lab</h5>
                <form class="form-card" action="/lab" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-12 flex-column d-flex"> <label class="form-control-label px-3">Nama Lab<span class="text-danger"> *</span></label> <input type="text" id="name" name="name" placeholder="Nama Lab"> </div>
                    </div>
                    <div class="form-group col-13 flex-column d-flex">
                        <select class="form-control costume-form-input @error('type') is-invalid @enderror" id="type" name="type" aria-placeholder="type">
                            <option value="" selected disabled hidden>Type</option>
                            <option value="Patologi Anatomi">Patologi Anatomi</option>
                            <option value="Mikrobiologi Klinik">Mikrobiologi Klinik</option>
                            <option value="Biomolekuler">Biomolekuler</option>
                            <option value="Parasitologi">Parasitologi</option>
                            <option value="Darah">Darah</option>
                        </select>
                    </div>
                    <div class="row justify-content-end">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-success">Submit</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
