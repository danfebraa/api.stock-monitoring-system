<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route('products.create')}}" class="bg-blue-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                Create
            </a>
        </div>
    </div>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/products-template" class="bg-pink-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="button" style="transition: all .15s ease">
                Download XLSX
            </a>
            <form action="{{route('upload-products')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="myFile" name="upload_file">
                <button class="bg-green-500 text-white active:bg-pink-600 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all .15s ease">
                    Upload XLSX
                </button>
            </form>
        </div>
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{  $slot }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
