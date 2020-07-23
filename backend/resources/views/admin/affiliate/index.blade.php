@extends('layouts.admin')	

@section('content')	
<div class="content-header">	
    <div class="container-fluid">	
        <div class="row mb-2">	
            <div class="col-sm-6">	
                <h1 class="m-0 text-dark">Affilate Comission Page</h1>	
            </div>	
            <div class="col-sm-6">	
                <ol class="breadcrumb float-sm-right">	
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Affilate Comission</li>
                </ol>	
            </div>	
        </div>	
    </div>	
</div>	

<div class="content">	
    <div class="container-fluid">	
        <div class="row">	
            <div class="col-lg-12">	
                <div class="card card-primary">	
                    <div class="card-header">	
                        <div class="d-flex justify-content-between align-items-center">    	
                            <h3 class="card-title">Edit Comission</h3>	
                        </div>	
                    </div>	
                    <form action="{{ route('comission.update') }}" method="post" enctype="multipart/form-data">	
                        @csrf 	
                        <div class="card-body">	
                            <div class="row">	
                                <div class="col-8 offset-2">	
                                    @include('includes.validation')	
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Level 1 Comission</label>
                                                <input type="text" name="level1" class="form-control" placeholder="Level 1 Comission" value="{{ $comission->level1 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 2 Comission</label>
                                                <input type="text" name="level2" class="form-control" placeholder="Level 2 Comission" value="{{ $comission->level2 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 3 Comission</label>
                                                <input type="text" name="level3" class="form-control" placeholder="Level 3 Comission" value="{{ $comission->level3 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 4 Comission</label>
                                                <input type="text" name="level4" class="form-control" placeholder="Level 4 Comission" value="{{ $comission->level4 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 5 Comission</label>
                                                <input type="text" name="level5" class="form-control" placeholder="Level 5 Comission" value="{{ $comission->level5 }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Level 6 Comission</label>
                                                <input type="text" name="level6" class="form-control" placeholder="Level 6 Comission" value="{{ $comission->level6 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 7 Comission</label>
                                                <input type="text" name="level7" class="form-control" placeholder="Level 7 Comission" value="{{ $comission->level7 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 8 Comission</label>
                                                <input type="text" name="level8" class="form-control" placeholder="Level 8 Comission" value="{{ $comission->level8 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 9 Comission</label>
                                                <input type="text" name="level9" class="form-control" placeholder="Level 9 Comission" value="{{ $comission->level9 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Level 10 Comission</label>
                                                <input type="text" name="level10" class="form-control" placeholder="Level 10 Comission" value="{{ $comission->level10 }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Cart Percentage</label>
                                                <input type="number" name="cart_percentage" class="form-control" placeholder="Cart Percenatage" value="{{ $comission->cart_percentage }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Min Withdraw</label>
                                                <input type="number" name="min_withdraw" class="form-control" placeholder="Min Withdraw" value="{{ $comission->min_withdraw }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Rupee to points</label>
                                                <input type="number" name="rupee_to_points" class="form-control" placeholder="Rupee to Points" value="{{ $comission->rupee_to_points }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">New User Points</label>
                                                <input type="number" name="new_user_points" class="form-control" placeholder="new user points" value="{{ $comission->new_user_points }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Referrer User Points(Who Refer the new user)</label>
                                                <input type="number" name="referrer_user_points" class="form-control" placeholder="referrer user points" value="{{ $comission->referrer_user_points }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>	
                                    <div class="form-group">	
                                        <button type="submit" class="btn btn-primary">Update Affilate Comission</button>	
                                    </div>	
                                </div>	
                            </div>	
                        </div>	
                    </form>	
                </div>	
            </div>	
        </div>	
    </div>	
</div>	
@endsection	

@section('style')	
    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" />	
@endsection	

@section('script')	
    <script type="text/javascript" src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>	
    <script type="text/javascript" src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>	
    <script type="text/javascript">	
        $(function () {	
            $('#startDate').datetimepicker({	
                format: 'YYYY-MM-DD HH:mm',	
            });	
            $('#endDate').datetimepicker({	
                format: 'YYYY-MM-DD HH:mm',	
            });	
        });	
    </script>	
@endsection 