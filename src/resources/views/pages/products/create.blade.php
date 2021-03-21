<x-product-layout>
    <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Product Information</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Input product information make sure that the product doesn't exist.
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('products.store')}}" method="POST">
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
                                <input type="text" name="description" id="description" value="{{old('descriptioni')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-600 @enderror ">
                                @error('description')
                                    <div class="text-xs text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="product_type_id" class="block text-sm font-medium text-gray-700">Product Types</label>
                                <select type="text" name="product_type_id" id="product_type_id" value="{{old('product_type_id')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('product_type_id') border-red-600 @enderror ">
                                    <option value=""></option>
                                    @foreach($productTypes as $productType)
                                        <option value="{{$productType->id}}" {{ (old("product_type_id") == $productType->id ? "selected":"") }}>{{$productType->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_type_id')
                                    <div class="text-xs text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="text" name="quantity" id="quantity" value="{{old('quantity')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('quantity') border-red-600 @enderror ">
                                @error('quantity')
                                    <div class="text-xs text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Base Price</label>
                                <input type="text" name="price" id="price" value="{{old('price')}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('price') border-red-600 @enderror ">
                                @error('price')
                                    <div class="text-xs text-red-600">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <label for="added_by" class="block text-sm font-medium text-gray-700">Added By</label>
                                <input type="text" name="added_by" id="postal_code" readonly value="{{Auth::user()->name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" style="background: lightgray; cursor: not-allowed">
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</x-product-layout>
