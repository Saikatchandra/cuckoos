@extends('layouts.admin')	

@section('content')	
<div class="content-header">	
    <div class="container-fluid">	
        <div class="row mb-2">	
            <div class="col-sm-6">	
                <h1 class="m-0 text-dark">Campaign Create Page</h1>	
            </div>	
            <div class="col-sm-6">	
                <ol class="breadcrumb float-sm-right">	
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>	
                    <li class="breadcrumb-item"><a href="{{ route('campaign.index') }}">Campaign List</a></li>	
                    <li class="breadcrumb-item active">Create Campaign</li>	
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
                            <h3 class="card-title">Create Campaign</h3>	
                           @can('campaign index') <a href="{{ route('campaign.index') }}" class="btn btn-light text-dark">Campaign list</a>	@endcan
                        </div>	
                    </div>	
                    <form action="{{ route('campaign.store') }}" method="post" enctype="multipart/form-data">	
                        @csrf 	
                        <div class="card-body">	
                            <div class="row">	
                                <div class="col-8 offset-2">	
                                    @include('includes.validation')	
                                    <div class="row">	
                                        <div class="col-6">	
                                            <div class="form-group">	
                                                <label for="campaignName">Campaign Name</label>	
                                                <input type="text" class="form-control" name="name" id="campaignName" placeholder="Enter name" value="{{ old('name') }}">	
                                            </div>	
                                            <div class="form-group">	
                                                <label for="campaignBanner">Banner <small>(optional)</small> </label>	
                                                <div class="custom-file">	
                                                    <input type="file" class="custom-file-input" name="banner" id="campaignBanner">	
                                                    <label class="custom-file-label" for="campaignBanner">Choose file</label>	
                                                </div>	
                                            </div>	
                                            <div class="form-group">	
                                                <label for="campaignBanner">Discount <small>(Percentage)</small> </label>	
                                                <input type="text" name="discount" placeholder="Enter percentage" class="form-control">	
                                            </div>	
                                            <div class="form-group">	
                                                <label for="status"> Select Status </label>	
                                                <select name="status" id="status" class="form-control">	
                                                    <option value="0">Inactive</option>	
                                                    <option value="1">Active</option>	
                                                </select>	
                                            </div>	
                                        </div>	
                                        <div class="col-6">	
                                             <div class="form-group">	
                                                <label for="startDate">Start Date</label>	
                                                <input type="text" name="start_date" class="form-control datetimepicker-input" id="startDate" data-toggle="datetimepicker" data-target="#startDate" placeholder="Please click here to add a date">	
                                            </div>	
                                            <div class="form-group">	
                                                <label for="startDate">End Date</label>	
                                                <input type="text" name="end_date" class="form-control datetimepicker-input" id="endDate" data-toggle="datetimepicker" data-target="#endDate" placeholder="Please click here to add a date">	
                                            </div>	
                                            <div class="form-group">	
                                                <label for="description">Description <small>(Optional)</small> </label>	
                                                <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter description"></textarea>	
                                            </div>	
                                        </div>	
                                    </div>	
                                    <hr>	
                                    <div class="form-group">	
                                        <button type="submit" class="btn btn-primary">Create Campaign</button>	
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