@extends('layouts.app')

@section('breadcrumbs')
{{ Breadcrumbs::render('owner-stable-approval-step-1') }}
@endsection

@section('content')
<div class="d-flex flex-row">
    <!--begin::Aside-->
    @include('app-owner._aside')
    <!--end::Aside-->
    <!--begin::Content-->
    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom card-stretch">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Create Horse Breed</h3>
                    <span class="text-muted font-weight-bold font-size-sm mt-1">Create your new horse breed</span>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
            <form class="form" name="createform" id="createform" action="{{ route('app_owner.horse.horse_breed.update', $item->id) }}" method="POST">
                @method('PUT')
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">Horse Breed</label>
                        <div class="col-lg-9 col-xl-6">
                            <input type="text" class="form-control form-control-lg form-control-solid" name="name" placeholder=" Enter Horse Breed" value="{{ $item->name }}">                            
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-check"></i> Save</button>
                            <a href="{{ route('app_owner.horse.horse_breed.index') }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </form>
            <!--end::Form-->
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@push('page-scripts')
<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\HorseBreedStore') !!}
@endpush