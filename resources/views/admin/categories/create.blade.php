@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('content')

<form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    @include('admin.categories._form', [
        'button_label' => 'Add'
    ])
</form>
@endsection