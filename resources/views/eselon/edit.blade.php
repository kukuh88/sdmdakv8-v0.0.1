@extends('layouts.master')

@section('page-title', 'ALL ESELON')

@section('breadcrumbs')
    <li class="breadcrumb-item">Roles</li>
    </li>
    <li class="breadcrumb-item">Eselon</li>
    <li class="breadcrumb-item active">Edit Eselon</li>
@endsection

@section('style_css')
    <style>
        .table-responsive {
            font-size: .8em !important;
        }

        div.dataTables_processing {
            z-index: 1;
        }
    </style>
@endsection

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('sukses') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title">EDIT Eselon</h5>
                        </div>
                        <div class="col-6">
                            <div class="right float-end">
                                <a href="/eselon" type="button" class="btn btn-outline-primary" style="margin-top: 12px;">
                                    Back
                                </a>
                            </div>
                            <!-- Basic Modal -->
                        </div>
                    </div>


                    <form action="{{ route('eselon.update', $eselon) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')

                        <!-- Eselon -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Eselon</label>
                            <div class="col-sm-5">
                                <input name="eselon" type="text" class="form-control" id="eselon"
                                    aria-describedby="emailHelp" placeholder="Nama book" value="{{ $eselon->eselon }}">
                            </div>
                        </div>

                        <!-- Min Exselon -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Minimum Group</label>
                            <div class="col-sm-5">
                                <input name="min_gol" type="text" class="form-control" id="min_gol"
                                    aria-describedby="emailHelp" placeholder="Minimal Golongan"
                                    value="{{ $eselon->min_gol }}">
                            </div>
                        </div>

                        <!-- Max Exselon -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Maximum group</label>
                            <div class="col-sm-5">
                                <input name="max_gol" type="text" class="form-control" id="max_gol"
                                    aria-describedby="emailHelp" placeholder="Maximal Golongan"
                                    value="{{ $eselon->max_gol }}">
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Submit Button</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-outline-primary">Save Update</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </div>
@endsection
