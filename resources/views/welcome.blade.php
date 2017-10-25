<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('assets/bootstrap/favicon.ico') }}">

    <title>Surat Keterangan - CS</title>
    <link rel="stylesheet" type="text/css" href="">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Sweetalert2 -->
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

    {{-- dataTables --}}
    <link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('assets/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/bootstrap/css/navbar-fixed-top.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>

  </head>

  <body>

    <div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">

          <div class="col-md-5">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3>Surat Keterangan Domisili Usaha</h3>
                  </div>
                  <div class="panel-body">
                      <tbody>
                          <h3>Syarat :</h3>
                          <ul>
                              <li>Fotocopy KTP</li>
                              <li>Fotocopy KK</li>
                              <li>Surat Pernyataan Usaha Yang Diketahui KEPLING</li>
                              <li><i>Untuk CV dan PT</i> : Fotocopy Akta Notaris</li><br><br>
                              <a onclick="addFormSKDU()" class="btn btn-primary pull-right" style="margin-top: -8px;">Ajukan</a>
                          </ul>
                      </tbody>
                  </div>
              </div>
          </div>

          <div class="col-md-5">
              <div class="panel panel-default">
                  <div class="panel-heading">
                      <h3>Surat Keterangan Tidak Mampu </h3>
                  </div>
                  <div class="panel-body">
                      <tbody>
                          <h3>Syarat :</h3>
                          <ul>
                              <li>Fotocopy KTP</li>
                              <li>Fotocopy KK</li>
                              <li>Surat Pernyataan Tidak Mampu Yang Diketahui KEPLING</li>
                              <li>Fotocopy RASKIN</li>
                              <li>Fotocopy KPS (Kartu Perlindungan Sosial) *<i><b>Jika ada</b></i></li><br><br>
                              <a onclick="addFormSKTM()" class="btn btn-primary pull-right" style="margin-top: -8px;">Ajukan</a>
                          </ul>
                      </tbody>
                  </div>
              </div>
          </div>


      </div>    

      @include('form')

    </div> 


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    {{-- dataTables --}}
    <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script type="text/javascript">
        var tabel1 = $('#skdu-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('api/skdu') }}",
                        columns: [
                            {data: 'id', name:'id'},
                            {data: 'name', name:'name'},
                            {data: 'nokk', name:'nokk'},
                            {data: 'nohp', name:'nohp'},
                            {data: 'action', name:'action', orderable: false, searchable:false},
                        ]
                    });

         var table2 = $('#sktm-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('api/sktm') }}",
                        columns: [
                            {data: 'id', name:'id'},
                            {data: 'name', name:'name'},
                            {data: 'nokk', name:'nokk'},
                            {data: 'nohp', name:'nohp'},
                            {data: 'action', name:'action', orderable: false, searchable:false},
                        ]
                    });

        function addFormSKDU(){
            save_method = "add1";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('#modal-title').text('Add Skdu');
        }

        function addFormSKTM(){
            save_method = "add2";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('#modal-title').text('Add Sktm');
        }

        


        $(function(){
            $('#modal-form form').validator().on('submit', function(e){
                if(!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if(save_method == 'add1') url ="{{ url('skdu') }}";
                    else
                        url ="{{ url('sktm') }}";

                    $.ajax({
                        url : url,
                        type : "POST",
                        data : $('#modal-form form').serialize(),
                        success : function($data){
                            $('#modal-form').modal('hide');
                            swal({
                                title: 'Sukses!',
                                text: 'Data berhasil dikirim!',
                                type: 'success',
                                timer: '2000'
                          })
                        },
                        error : function(){
                            swal({
                            title:'Oops..',
                            text: 'Ada yang salah!',
                            type: 'error',
                            timer: '2000'
                          })
                        }
                    });
                    return false;
                }
            });


        });



        // $(function(){
        //     $('#modal-form form').validator().on('submit', function(e){
        //         if(!e.isDefaultPrevented()){
        //             var id = $('#id').val();
        //             if(save_method == 'add2') url ="{{ url('sktm') }}";
        //             else
        //                 url = "{{ url('sktm'). '/' }}" + id;

        //             $.ajax({
        //                 url : url,
        //                 type : "POST",
        //                 data : $('#modal-form form').serialize(),
        //                 success : function($data){
        //                     $('#modal-form').modal('hide');
        //                     table2.ajax.reload();
        //                 },
        //                 error : function(){
        //                     alert ('Ops! Ada kesalahan!');
        //                 }
        //             });
        //             return false;
        //         }
        //     });
        // });
    </script>
  </body>
</html>
