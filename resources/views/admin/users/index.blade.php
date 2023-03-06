<?
/**
 * @var $paginator
 */
?>

@extends('layouts.app')

@section('content')
    <h2>Пользователи</h2>
    <table @class(['table'])>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">tg_id</th>
            <th scope="col">country</th>
            <th scope="col">operator</th>
            <th scope="col">language</th>
        </tr>
        </thead>
        <tbody>
        @php
            /** @var $paginator \Illuminate\Pagination\Paginator  */
        @endphp
        @foreach($paginator->getCollection() as $item)
            <tr>
                <th scope="col">{{ $item->id }}</th>
                <td>{{ $item->tg_id }}</td>
                <td>{{ $item->country_id }}</td>
                <td>{{ $item->operator_id }}</td>
                <td>{{ $item->language }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        <nav aria-label="Page navigation example">
            {!! $paginator->links() !!}
        </nav>
    </div>
@endsection


