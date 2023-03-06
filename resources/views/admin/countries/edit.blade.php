<?
/**
 *
 */

?>

@extends('layouts.app')

@section('content')
    @php
        /** @var \Illuminate\Support\ViewErrorBag $errors */
    @endphp
    @if($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @php
        /** @var App\Models\Country $country */
    @endphp

    <h1>Страна "{{ $country->name }}"</h1>

    @if($country->exists)
        <form method="POST" action="{{ route('admin.countries.update', $country->id) }}">
            @method('PATCH')
            @else
                <form method="POST" action="{{ route('admin.countries.store') }}">
                    @endif
                    @csrf
                    <div class="container">
                        @include('admin.countries.includes.form')
                    </div>
                </form>
                @if($country->exists)
                    <a href="{{ route('admin.operator.gets', ['country' => $country->id]) }}" class="btn btn-warning">Посмотреть операторов</a>
                @endif
                <a href="{{ route('admin.countries.index') }}" class="btn btn-info">Страны</a>
@endsection


