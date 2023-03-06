@extends('layouts.app')

@section('content')
    <table @class(['table'])>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
        </tr>
        </thead>
        <tbody>

        @foreach($operators as $item)
        <tr>
            <th scope="col">{{ $item->id }}</th>
            <td>{{ $item->name }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.countries.edit', ['country' => $country]) }}" class="btn btn-info">Вернутся к стране</a>
    <a href="{{ route('admin.countries.index') }}" class="btn btn-info">Страны</a>
@endsection


