@extends ('AdminDashboard.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-header">
            <h2 class="content-title">Add New Product</h2>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                    <button type="submit" class="btn btn-md rounded font-sm hover-up">Publish</button>
                
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Basic</h4>
            </div>
            <div class="card-body">
                <!-- The same form continues here -->
                <div class="mb-4">
                    <label for="product_name" class="form-label">Product title <i class="text-danger">*</i></label>
                    <input type="text" name="product_name" placeholder="Type here" class="form-control" id="product_name" />
                </div>
                <div class="mb-4">
                    <label class="form-label">Product description<i class="text-danger">*</i></label>
                    <textarea name="product_description" placeholder="Type here" class="form-control" rows="4"></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Total Quantity <i class="text-danger">*</i></label>
                    <input name="quantity" id="quantity" type="number" class="form-control"/>
                </div>
                <label class="form-check mb-4">
                    <input name="is_affiliate" id="affiliate_checkbox" class="form-check-input" type="checkbox" />
                    <span class="form-check-label">Affiliate the Product</span>
                </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label">Normal price <i class="text-danger">*</i></label>
                            <input name="normal_price" id="normal_price" placeholder="Rs" type="number" class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label">Affiliate price</label>
                            <input name="affiliate_price" id="affiliate_price" placeholder="Rs" type="number" class="form-control" readonly />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-4">
                            <label class="form-label">Commission</label>
                            <input name="commission_percentage" id="commission" type="number" placeholder="%" class="form-control" readonly />
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Total price</label>
                    <input name="total_price" id="total_price" placeholder="Rs" type="number" class="form-control" readonly />
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Media</h4>
            </div>
            <div class="card-body">
                <div class="input-upload">
                    <img src="{{ asset('backend/assets/imgs/theme/upload.svg') }}" alt="" />
                    <input name="images[]" id="media_upload" class="form-control" type="file" multiple />
                </div>
                <div class="image-preview mt-4" id="image_preview_container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <!-- Image previews will appear here -->
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h4>Organization</h4>
            </div>
            <div class="card-body">
                <div class="row gx-2">
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Category <i class="text-danger">*</i></label>
                        <select name="category_id" class="form-select" id="categorySelect">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Subcategory</label>
                        <select name="subcategory_id" class="form-select" id="subcategorySelect" disabled>
                            <option value="">Select a subcategory</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label class="form-label">Sub-Subcategory</label>
                        <select name="sub_subcategory_id" class="form-select" id="subsubcategorySelect" disabled>
                            <option value="">Select a sub-subcategory</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="product_tags" class="form-label">Tags</label>
                        <input name="tags" type="text" class="form-control" />
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const affiliateCheckbox = document.getElementById('affiliate_checkbox');
        const normalPriceInput = document.getElementById('normal_price');
        const affiliatePriceInput = document.getElementById('affiliate_price');
        const commissionInput = document.getElementById('commission');
        const totalPriceInput = document.getElementById('total_price');

        affiliatePriceInput.readOnly = true;
        commissionInput.readOnly = true;

        affiliateCheckbox.addEventListener('change', function () {
            const isChecked = affiliateCheckbox.checked;
            affiliatePriceInput.readOnly = !isChecked;
            commissionInput.readOnly = !isChecked;

            calculateTotalPrice();
        });

        [normalPriceInput, affiliatePriceInput, commissionInput].forEach(input => {
            input.addEventListener('input', calculateTotalPrice);
        });

        function calculateTotalPrice() {
            const normalPrice = parseFloat(normalPriceInput.value) || 0;
            let totalPrice = normalPrice;

            if (affiliateCheckbox.checked) {
                const affiliatePrice = parseFloat(affiliatePriceInput.value) || 0;
                const commission = parseFloat(commissionInput.value) || 0;
                totalPrice = affiliatePrice + (affiliatePrice * (commission / 100));
            }

            totalPriceInput.value = totalPrice.toFixed(2);
        }
    });

 

    //image upload
    document.addEventListener('DOMContentLoaded', function () {
        const mediaUploadInput = document.getElementById('media_upload');
        const imagePreviewContainer = document.getElementById('image_preview_container');
        let currentFiles = []; 

        mediaUploadInput.addEventListener('change', function () {
            const files = Array.from(mediaUploadInput.files);
            files.forEach((file, index) => {
                currentFiles.push(file); 
                const reader = new FileReader();
                reader.onload = function (e) {
                    const imageUrl = e.target.result;
                    const imageContainer = document.createElement('div');
                    imageContainer.classList.add('position-relative');
                    imageContainer.style.width = '100px';
                    imageContainer.style.height = '100px';

                    const imgElement = document.createElement('img');
                    imgElement.src = imageUrl;
                    imgElement.classList.add('img-thumbnail');
                    imgElement.style.width = '100%';
                    imgElement.style.height = '100%';
                    imgElement.style.objectFit = 'cover';

                    const deleteIcon = document.createElement('span');
                    deleteIcon.classList.add('position-absolute', 'top-0', 'end-0', 'bg-danger', 'text-white', 'rounded-circle', 'p-1', 'cursor-pointer');
                    deleteIcon.innerHTML = '&times;';
                    deleteIcon.style.cursor = 'pointer';

                    deleteIcon.addEventListener('click', function () {
                        imageContainer.remove();
                        removeImageFromFileList(currentFiles.indexOf(file));
                    });

                    imageContainer.appendChild(imgElement);
                    imageContainer.appendChild(deleteIcon);
                    imagePreviewContainer.appendChild(imageContainer);
                };

                reader.readAsDataURL(file);
            });

            updateFileInput(); 
        });

        function removeImageFromFileList(index) {
            currentFiles.splice(index, 1); 
            updateFileInput();
        }

        function updateFileInput() {
            const dt = new DataTransfer();
            currentFiles.forEach(file => {
                dt.items.add(file);
            });
            mediaUploadInput.files = dt.files; 
        }
    });


    //categories dropdown
    document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const subsubcategorySelect = document.getElementById('subsubcategorySelect');

    categorySelect.addEventListener('change', function () {
        const categoryId = this.value;

        subcategorySelect.innerHTML = '<option value="">Select a subcategory</option>';
        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subcategorySelect.disabled = true;
        subsubcategorySelect.disabled = true;

        if (categoryId) {
            fetch(`/api/subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching subcategories:', error));
        }
    });

    subcategorySelect.addEventListener('change', function () {
        const subcategoryId = this.value;

        subsubcategorySelect.innerHTML = '<option value="">Select a sub-subcategory</option>';
        subsubcategorySelect.disabled = true;

        if (subcategoryId) {
            fetch(`/api/sub-subcategories/${subcategoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subSubcategory => {
                        const option = document.createElement('option');
                        option.value = subSubcategory.id;
                        option.textContent = subSubcategory.name;
                        subsubcategorySelect.appendChild(option);
                    });
                    subsubcategorySelect.disabled = false;
                })
                .catch(error => console.error('Error fetching sub-subcategories:', error));
        }
    });
});


</script>

@endsection
