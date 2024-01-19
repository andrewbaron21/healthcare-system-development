@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
            <div class="col-12">
                <div class="card">

                @if($roles->contains('name', 'professional')) 
                    <a class="btn btn-primary col-3 mb-3" href="{{ route('clinicalhistories.create') }}">Create</a>
                @endif
                <div class="card-header">{{ __('Clinical histories') }}</div>
                    <div class="card-body">
                        <index-clinical-history 
                            :roles="{{ $roles }}"
                            :user-id="{{ $userId }}"
                            :clinical-histories="{{ json_encode($clinicalHistories) }}"
                        ></index-clinical-history>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
