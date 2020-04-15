<div class="max-w-sm p6 mx-6 m-3 flex flex-col p-4 border-gray-900 border-4 tracking-wide justify-between w-full content-between rounded-md shadow-lg" style="width: 300px; min-height: 300px">
    <blockquote class="leading-normal">{{ $quote }}</blockquote>
    <div class="flex items-center">
        <div class="w-20 h-20 rounded-full mr-4 bg-cover bg-no-repeat bg-center" style="background-image: url({{ $image_url }})" title="{{ $name }}"></div>
        <div>
            <p class=" py-1 leading-none">{{ $name }}</p>
            <p class=" py-1">{{ $job_title }}</p>
        </div>
    </div>
</div>
