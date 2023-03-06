<?
/**
 * @var $paginator
 */
?>

@extends('layouts.app')

@section('content')
    <table @class(['table'])>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">title</th>
            <th scope="col">icon</th>
            <th scope="col">image</th>
            <th scope="col">action</th>
        </tr>
        </thead>
        <tbody>
        @php
            /** @var $paginator \Illuminate\Pagination\Paginator  */
        @endphp
        @foreach($paginator->getCollection() as $item)
            <tr>
                <th scope="col">{{ $item->id }}</th>
                <td><a href="{{ route('admin.countries.edit', $item->id) }}">{{ $item->name }}</a></td>
                <td>{{ $item->title_ru }}</td>
                <td>{{ $item->title_eng }}</td>
                <td>
                    @if(strpos($item->image, 'css://') !== false)
                        <span class="{{ substr($item->image, 6) }}"></span>
                    @else
                        <img src="{{ $item->image }}" alt="" width="48px" height="48px">
                    @endif
                </td>
                <td><a href="{{ route('admin.countries.destroy', $item->id) }}" class="btn btn-danger"><i
                            class="fa fa-times"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <nav aria-label="Page navigation example">
            {!! $paginator->links() !!}
        </nav>
    </div>
    <a href="{{ route('admin.countries.create') }}" class="btn btn-success">Добавить страну</a>
    <a href="{{ route('admin.countries.delete') }}" class="btn btn-danger">Удалить все страны</a>
@endsection


