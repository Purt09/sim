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
            <th scope="col">public_key</th>
            <th scope="col">bot_id</th>
            <th scope="col">percent</th>
            <th scope="col">category_id</th>
        </tr>
        </thead>
        <tbody>
        @php
            /** @var $paginator \Illuminate\Pagination\Paginator  */
        @endphp
        @foreach($paginator->getCollection() as $item)
            <tr>
                <th scope="col">{{ $item->id }}</th>
                <td><a href="{{ route('admin.bots.edit', $item->id) }}">{{ $item->public_key }}</a></td>
                <td>{{ $item->bot_id }}</td>
                <td>{{ $item->percent }}</td>
                <td>{{ $item->category_id }}</td>
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


