@extends('layouts.master')

@section('page-title', 'Form MPP')

@section('breadcrumbs')
    <li class="breadcrumb-item">Form MPP</li>
    <li class="breadcrumb-item active">Pensiun 12 / 6</li>
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
    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">MPP 12 / 6 </h5>
                            </div>
                            <div class="col-6">
                                <div class="right float-end">
                                    <a href="/employee" type="button" class="btn btn-outline-primary"
                                        style="margin-top: 12px;">
                                        Back
                                    </a>
                                </div>
                                <!-- Basic Modal -->
                            </div>
                        </div>

                        <form action="{{ route('karyawan.update-pensiun', $karyawan) }}" method="POST">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="row mb-3{{ $errors->has('pilihan_pensiun') ? ' has-error' : '' }}">
                                <label for="inputText" class="col-sm-2 col-form-label">Select MPP</label>
                                <div class="col-sm-8">
                                    <select name="pilihan_pensiun" id="pilihan_pensiun" class="form-control" required>
                                        <option value="12">12 Month</option>
                                        <option value="6">6 Month</option>
                                    </select>
                                    @if ($errors->has('pilihan_pensiun'))
                                        <span class="help-block"
                                            style="color: red;">{{ $errors->first('pilihan_pensiun') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-outline-primary">Save MPP</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
