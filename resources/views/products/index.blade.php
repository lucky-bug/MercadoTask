@extends('layouts.app')

@section('content')
<div id="products-list" newItemRoute="{{ route('products.create') }}" userId="{{ Auth::id() }}">
</div>
@endsection
