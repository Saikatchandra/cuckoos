@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Setting Page</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Setting</li>
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
                            <h3 class="card-title">Edit Setting</h3>
                        </div>
                    </div>
                    <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    @include('includes.validation')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="siteName">Site Name</label>
                                                <input type="text" class="form-control" name="site_name" id="siteName" placeholder="Enter site name" value="{{ $setting->site_name }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="siteLogo">Site Logo</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo" id="siteLogo">
                                                    <label class="custom-file-label" for="siteLogo">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="siteLogo">Site Favicon</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="favicon" id="siteFavicon">
                                                    <label class="custom-file-label" for="siteFavicon">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="adminEmail">Admin email</label>
                                                <input type="email" class="form-control" name="email" id="adminEmail" placeholder="Enter email" value="{{ $setting->email }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="adminPhone">Support Phone</label>
                                                <input type="text" class="form-control" name="phone" id="adminPhone" placeholder="Enter phone" value="{{ $setting->phone }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="facebookLink">Facebook Link</label>
                                                <input type="text" class="form-control" name="facebook" id="facebookLink" placeholder="facebook link" value="{{ $setting->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="twitterLink">twitter Link</label>
                                                <input type="text" class="form-control" name="twitter" id="twitterLink" placeholder="twitter link" value="{{ $setting->twitter }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="instagramLink">instagram Link</label>
                                                <input type="text" class="form-control" name="instagram" id="instagramLink" placeholder="instagram link" value="{{ $setting->instagram }}">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="youtubeLink">youtube Link</label>
                                                <input type="text" class="form-control" name="youtube" id="youtubeLink" placeholder="youtube link" value="{{ $setting->youtube }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="copyright">Copyright </label>
                                        <input type="text" class="form-control" name="copyright" id="copyright" placeholder="Enter copyright text" value="{{ $setting->copyright }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="siteName">Site address</label>
                                        <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter address">{{ $setting->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="siteName">Short Description</label>
                                        <textarea name="short_description" id="address" class="form-control" rows="2" placeholder="Enter address">{{ $setting->short_description }}</textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update Setting</button>
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