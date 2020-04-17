<div class="max-w-sm m-3 flex flex-col px-4 py-2 border-gray-900 border-1 tracking-wide justify-between w-full content-between bg-white rounded-md shadow-lg" style="width: 300px; min-height: 300px">
    <blockquote class="leading-normal">{{ $quote }}</blockquote>
    <div class="flex items-center">
        <div class="w-20 h-20 rounded-full mr-4 bg-cover bg-no-repeat bg-center fade-to-black-and-white" style="background-image: url({{ $image_url }})" title="{{ $name }}"></div>
        <div>
            <p class=" py-1 leading-none">{{ $name }}</p>
            <p class=" py-1">{{ $job_title }}</p>
        </div>
    </div>
</div>
