@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="name">Name:</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="surnames">Surnames:</label>
                    <input class="form-control" type="text" name="surnames" value="{{ old('surnames', $user->surnames) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password:</label>
                    <input class="form-control" type="password" name="password" placeholder="Leave blank to keep the current password">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
