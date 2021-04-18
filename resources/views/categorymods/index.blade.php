@extends('layouts.app')

@section('content')
<div class="col-10 m-auto">
    <div class="container-fluid mt-4">
        <table class="table col-12 m-auto table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome Categoria</th>
                    <th scope="col">data criação</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ date_format($item->created_at ,'d/m/Y H:i:s') }}</td>
                    <td><a href=""><i class="fas fa-edit"></i></i></a></td>
                    <td><a href="" style="color: red"> <i class="fas fa-trash-alt"></i></a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection