<div class="form-row">

    <div class="col-md-6 mb-3">
        <label for="category_id" class="col-form-label pt-0">{{ __('Category') }}</label>
        <select class="form-control" name="category_id" id="category_id" required>

            <option value="{{ isset($auction) ? $auction->category_id : '' }}">
                {{ isset($auction) ? $auction->category->name : '- - Select - -' }}</option>
            @forelse(_getAllCategories() as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @empty
            @endforelse
        </select>
    </div>
</div>

<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="product_title" class="col-form-label pt-0">{{ __('Product title') }}</label>
        <input type="text" name="product_title" class="form-control"
               value="{{ old('product_title', isset($auction) ? $auction->product_title : '') }}"
               autocomplete="off" required>
    </div>

</div>

<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="time" class="col-form-label pt-0">{{ __('Time') }}</label>
        <input type="text" name="time" class="form-control"
               value="{{ old('time', isset($auction) ? $auction->time : '') }}"
               autocomplete="off" required>
    </div>

</div>

<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="starting_price" class="col-form-label pt-0">{{ __('Starting price') }}</label>
        <input type="text" name="starting_price" class="form-control"
               value="{{ old('time', isset($auction) ? $auction->starting_price : '') }}"
               autocomplete="off" required>
    </div>

</div>

        <input type="text" name="user_id" class="form-control" hidden
               value="{{auth()->user()->id}}"
               autocomplete="off" required>

        <input type="text" name="status" class="form-control" hidden
               value="Start"
               autocomplete="off" required>

<div class="form-row">
    <div class="col-md-12 mb-3">
        <label for="images" class="col-form-label pt-0">{{ __('Images') }}</label>
        <input type="file" name="images[]" class="form-control" multiple>
    </div>

</div>

<div class="col-md-12 mb-3">
    <label for="description" class="col-form-label pt-0">{{ __('Description') }}</label>
    <textarea name="description" class="form-control" rows="10" cols="20" autocomplete="off" required>{{ old('description', isset($auction) ? $auction->description : '') }}</textarea>
</div>
