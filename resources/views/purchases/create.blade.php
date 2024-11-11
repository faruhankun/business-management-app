@extends('layouts.app')

@section('title', 'Create Purchase')

@section('content')
    <h1>Create New Purchase</h1>
    <form action="{{ route('purchases.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="purchase_date">Purchase Date</label>
            <input type="date" name="purchase_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_amount">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" class="form-control" required>
        </div>
		
		<h3>Products</h3>
		<div id="product-selection">
			<div class="form-group">
				<label for="product_id">Select Product</label>
				<select name="products[0][product_id]" class="form-control">
					@foreach ($products as $product)
						<option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
					@endforeach
				</select>
				<label for="quantity">Quantity</label>
				<input type="number" name="products[0][quantity]" class="form-control" min="1" required>
			</div>
		</div>
		<button type="button" id="add-product" class="btn btn-secondary">Add Another Product</button>
		
        <button type="submit" class="btn btn-primary">Save Purchase</button>
    </form>
	
	<script>
		let productIndex = 1;
		document.getElementById('add-product').addEventListener('click', function () {
			const productSelection = document.getElementById('product-selection');
			const newProductDiv = document.createElement('div');
			newProductDiv.classList.add('form-group');
			newProductDiv.innerHTML = `
				<label for="product_id">Select Product</label>
				<select name="products[${productIndex}][product_id]" class="form-control">
					@foreach ($products as $product)
						<option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
					@endforeach
				</select>
				<label for="quantity">Quantity</label>
				<input type="number" name="products[${productIndex}][quantity]" class="form-control" min="1" required>
			`;
			productSelection.appendChild(newProductDiv);
			productIndex++;
		});
	</script>
@endsection