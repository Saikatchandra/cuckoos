@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Affiliate Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>$150</h3>
                        <p>Total Earning</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>530</h3>
                        <p>Total Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>4403</h3>
                        <p>Total Registration</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>$65,000</h3>
                        <p>Total Paid</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h2> Referral by Level </h2>
                <hr>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 1</span>
                        <span class="info-box-number">{{ auth()->user()->level1->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 2</span>
                        <span class="info-box-number">{{ auth()->user()->level2->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 3</span>
                        <span class="info-box-number">{{ auth()->user()->level3->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 4</span>
                        <span class="info-box-number">{{ auth()->user()->level4->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 5</span>
                        <span class="info-box-number">{{ auth()->user()->level5->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 6</span>
                        <span class="info-box-number">{{ auth()->user()->level6->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 7</span>
                        <span class="info-box-number">{{ auth()->user()->level7->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 8</span>
                        <span class="info-box-number">{{ auth()->user()->level8->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Level 9</span>
                        <span class="info-box-number">{{ auth()->user()->level9->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-tag"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Level 10</span>
                        <span class="info-box-number">{{ auth()->user()->level10->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection