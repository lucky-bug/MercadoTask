@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Create Product
                    <a href="{{ url()->previous() }}"
                       class="btn btn-sm btn-link float-right">
                        Back
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input id="name" type="text" name="name" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="unit">Unit:</label>
                            <input id="unit" type="text" name="unit" class="form-control" value="Kilogram"/>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input id="price" type="number" name="price" class="form-control" value="0" min="0" step="0.01" required/>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input id="quantity" type="number" name="quantity" class="form-control" value="0" min="0" required/>
                        </div>

                        <div class="text-right">
                            <a href="{{ url()->previous() }}" class="btn btn-link">Back</a>
                            <input type="submit" class="btn btn-primary" value="Create"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
