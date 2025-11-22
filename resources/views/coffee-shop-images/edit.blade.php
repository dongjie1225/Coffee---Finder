@extends('layouts.bootstrap')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3><i class="bi bi-pencil"></i> Edit Image</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Current Image</label>
                    <div>
                        <img src="{{ asset('storage/' . $coffeeShopImage->image_path) }}" 
                             alt="{{ $coffeeShopImage->title }}" 
                             class="img-thumbnail" 
                             style="max-height: 300px;">
                    </div>
                </div>

                <form action="{{ route('coffee-shops.images.update', [$coffeeShop, $coffeeShopImage]) }}" 
                      method="POST" 
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $coffeeShopImage->title) }}" 
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  required>{{ old('description', $coffeeShopImage->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">New Image (optional)</label>
                        <input type="file" 
                               class="form-control @error('image') is-invalid @enderror" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               onchange="previewNewImage(this)">
                        <div class="form-text">Leave empty to keep current image. Maximum file size: 5MB</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="newImagePreview" class="mt-3" style="display: none;">
                            <label class="form-label">New Image Preview:</label>
                            <img id="newPreview" src="" alt="New Preview" class="img-thumbnail" style="max-height: 300px; max-width: 100%;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('coffee-shops.show', $coffeeShop) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewNewImage(input) {
    const preview = document.getElementById('newPreview');
    const previewDiv = document.getElementById('newImagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.style.display = 'block';
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewDiv.style.display = 'none';
    }
}
</script>
@endsection

