@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Create Clinical History') }}</div>
                <div class="card-body">
                    <create-clinical-history></create-clinical-history>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
