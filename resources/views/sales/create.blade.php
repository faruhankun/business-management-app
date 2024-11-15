@extends('layouts.app')

@section('content')
<h1>Create Sales Order</h1>

<form action="{{ route('sales.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="customer_name">Customer Name</label>
        <input type="text" name="customer_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="sale_date">Sale Date</label>
        <input type="date" name="sale_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="warehouse_id">Select Warehouse</label>
        <select name="warehouse_id" class="form-control" required>
            @foreach($warehouses as $warehouse)
                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>

    <h3>Products</h3>
    <div id="product-section">
        <div class="form-group">
            <label for="products[0][product_id]">Product</label>
            <select name="products[0][product_id]" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                @endforeach
            </select>
            <label for="products[0][quantity]">Quantity</label>
            <input type="number" name="products[0][quantity]" class="form-control" required>
            <label for="products[0][price]">Price</label>
            <input type="number" name="products[0][price]" class="form-control" required>
        </div>
    </div>
    <button type="button" id="add-product" class="btn btn-secondary">Add Product</button>
    <button type="submit" class="btn btn-primary">Create Sale</button>
</form>

<script>
    let productIndex = 1;
    document.getElementById('add-product').addEventListener('click', function () {
        const productSection = document.getElementById('product-section');
        const newProduct = `
            <div class="form-group">
                <label for="products[${productIndex}][product_id]">Product</label>
                <select name="products[${productIndex}][product_id]" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
                <label for="products[${productIndex}][quantity]">Quantity</label>
                <input type="number" name="products[${productIndex}][quantity]" class="form-control" required>
                <label for="products[${productIndex}][price]">Price</label>
                <input type="number" name="products[${productIndex}][price]" class="form-control" required>
            </div>
        `;
        productSection.insertAdjacentHTML('beforeend', newProduct);
        productIndex++;
    });
</script>
@endsection
