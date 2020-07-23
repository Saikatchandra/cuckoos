@extends('layouts.admin')   

@section('content') 
<div class="content-header">    
    <div class="container-fluid">   
        <div class="row mb-2">  
            <div class="col-sm-6">  
                <h1 class="m-0 text-dark">Slider Create Page</h1>   
            </div>  
            <div class="col-sm-6">  
                <ol class="breadcrumb float-sm-right">  
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>    
                    <li class="breadcrumb-item"><a href="{{ route('campaign.index') }}">Slider List</a></li>    
                    <li class="breadcrumb-item active">Create Slider</li>   
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
                            <h3 class="card-title">Create Slider</h3>   
                 
                        </div>  
                    </div>  
                    <form action="{{ route('slider.update') }}" method="post" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="card-body"> 
                            <div class="row">   
                                <div class="col-8 offset-2">    
                                    @include('includes.validation') 
                                    <div class="row">   
                                        <div class="col-6"> 
                                            <div class="form-group">    
                                                <label for="sliderName">Slider Name</label> 
                                                <input type="text" class="form-control" name="title" id="sliderName" placeholder="Enter name" value="{{ $slider->title }}">   
                                            </div>  
                                      
                                            <div class="form-group">    
                                                <label for="sliderBanner">Banner <small></small> </label>   
                                                <div class="custom-file">   
                                                    <input type="file" class="custom-file-input" name="slider_image" id="sliderBanner"> 
                                                    <label class="custom-file-label" for="sliderBanner">Choose file</label> 
                                                </div>  
                                            </div>  
                                            
                                           
                                        </div>  
                                  
                                    </div>  
                                    <hr>    
                                    <div class="form-group">    
                                        <button type="submit" class="btn btn-primary">Create slider</button>    
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