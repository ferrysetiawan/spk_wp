@extends('layouts.global')
@section('title', 'Perhitungan MWP')

@section('content')
<section class="content-header">
    <h1>
      Perhitungan Metode Weighted Product
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('nilai')}}"> Nilai Kandidat</a></li>
      <li class="active">Perhitungan Metode Weighted Product</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
   
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Hasil Normalisasi Bobot Kriteria 
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body">
                        <table class="table table-bordered" id="weight">
                            <thead>
                                <tr>
                                    <th>
                                        Kriteria
                                    </th>
                                    <th>
                                        Weight
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $k)
                                <tr>
                                    <td>{{ $k->nama }}</td>
                                    <td>{{ $data['weight'][$k->id] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-danger">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        Nilai Vektor S
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="box-body">
                        <table class="table table-bordered" id="svalue">
                            <thead>
                                <tr>
                                    <th>
                                        Kandidat
                                    </th>
                                    <th>
                                        Nilai S
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($penerima as $p)
                                    <tr>
                                        <td>{{ $p->nama }}</td>
                                        <td>
                                            @foreach($data['s'] as $d)
            
            
                                                @if($p->id == $d['penerima'])
                                                    {{ $d['s'] }}&nbsp;
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                        Nilai Vektor V
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse">
                    <div class="box-body">
                        <table class="table table-bordered" id="vector">
                            <thead>
                                <tr>
                                    <th>
                                        Kandidat
                                    </th>
                                    <th>
                                        Nilai V
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($penerima as $p)
                                    <tr>
                                        <td>{{ $p->nama }}</td>
                                        <td>
                                            @if(array_key_exists($p->id, $data['v']))
                                                {{ $data['v'][$p->id]  }}
                                            @endif
            
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
@endsection



