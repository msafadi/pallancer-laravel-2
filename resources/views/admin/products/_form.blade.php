@if ($errors->any())
<div class="alert alert-danger">
    Error!
    <ul>
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-group mb-3">
    <label for="">Name:</label>
    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control @error('name') is-invalid @enderror">
    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Category:</label>
    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" @if($category->id == old('category_id', $product->category_id)) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Description:</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
    @error('description')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Image:</label>
    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
    @error('image')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Price:</label>
    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control @error('price') is-invalid @enderror">
    @error('price')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Sale Price:</label>
    <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="form-control @error('sale_price') is-invalid @enderror">
    @error('sale_price')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Quantity:</label>
    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="form-control @error('quantity') is-invalid @enderror">
    @error('quantity')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group mb-3">
    <label for="">Status:</label>
    <div>
        <label><input type="radio" name="status" value="in-stock" @if (old('status', $product->status) == 'in-stock') checked @endif>
            In Stock</label>
        <label><input type="radio" name="status" value="sold-out" @if (old('status', $product->status) == 'sold-out') checked @endif>
            Sold Out</label>
        <label><input type="radio" name="status" value="draft" @if (old('status', $product->status) == 'draft') checked @endif>
            Draft</label>
    </div>
    @error('status')
    <p class="invalid-feedback d-block">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>