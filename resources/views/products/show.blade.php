@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        About Product
                        <a href="{{ url()->previous() }}"
                           class="btn btn-sm btn-link float-right">
                            Back
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 row">
                                <div class="col-4 font-weight-bold">Name:</div>
                                <div class="col text-justify">{{ $data->name }}</div>
                            </div>

                            <div class="col-12">
                                <hr/>
                            </div>

                            <div class="col-md-12 row">
                                <div class="col-4 font-weight-bold">Unit:</div>
                                <div class="col">{{ $data->unit }}</div>
                            </div>

                            <div class="col-12">
                                <hr/>
                            </div>

                            <div class="col-md-12 row">
                                <div class="col-4 font-weight-bold">Price:</div>
                                <div class="col">{{ $data->price }}</div>
                            </div>

                            <div class="col-12">
                                <hr/>
                            </div>

                            <div class="col-md-12 row">
                                <div class="col-4 font-weight-bold">Quantity:</div>
                                <div class="col">{{ $data->quantity }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <form id="delete-form"
                              action="{{ route('products.destroy', $data->id) }}"
                              method="post"
                              class="hidden">
                            @method('delete')
                            @csrf
                        </form>

                        @if ($data->user_id === null || Auth::id() === $data->user_id)
                            <div class="text-right">
                                <button type="submit" form="delete-form" class="btn btn-outline-danger">
                                    Delete
                                </button>

                                <a href="{{ route('products.edit', $data->id) }}" class="btn btn-secondary">
                                    Update
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
