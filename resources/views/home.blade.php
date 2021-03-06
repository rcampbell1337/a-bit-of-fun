@extends('layouts.app')

@section('content')
<div style="background-image: url('https://wallpapercave.com/wp/wp4506801.jpg'); min-height: 500px;" class="bg-indigo-100 bg-cover bg-no-repeat">
    <div class="container px-4 mx-auto py-20">
        <div class="text-center max-w-2xl mx-auto">
            <h1 class="text-3xl md:text-4xl text-white font-medium mb-2">The Quote Storage Database</h1>
            @guest
                <button class="bg-indigo-600 text-white py-2 px-6 rounded-full text-xl mt-6"><a href="{{route('register')}}">Create an account here</a></button>
            @endguest
        </div>

        <div class="md:flex md:flex-wrap md:-mx-4 mt-6 md:mt-12 py-20 bg-white bg-opacity-80">

            <div class="md:w-1/3 md:px-4 xl:px-6 mt-8 md:mt-0 text-center">
                <span class="w-20 border-t-2 border-solid border-indigo-200 inline-block mb-3"></span>
                <h5 class="text-xl font-medium uppercase mb-4">Fresh Design</h5>
                <p class="text-gray-600">FWR blocks bring in an air of fresh design with their creative layouts and blocks, which are easily customizable</p>
            </div>

            <div class="md:w-1/3 md:px-4 xl:px-6 mt-8 md:mt-0 text-center">
                <span class="w-20 border-t-2 border-solid border-indigo-200 inline-block mb-3"></span>
                <h5 class="text-xl font-medium uppercase mb-4">Clean Code</h5>
                <p class="text-gray-600">FWR blocks are the cleanest pieces of HTML blocks, which are built with utmost care to quality and usability.</p>
            </div>

            <div class="md:w-1/3 md:px-4 xl:px-6 mt-8 md:mt-0 text-center">
                <span class="w-20 border-t-2 border-solid border-indigo-200 inline-block mb-3"></span>
                <h5 class="text-xl font-medium uppercase mb-4">Perfect Tool</h5>
                <p class="text-gray-600">FWR blocks is a perfect tool for designers, developers and agencies looking to create stunning websites in no time.</p>
            </div>

        </div>

    </div>
</div>

<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="relative min-h-screen flex flex-col items-center">
        <h1 class="text-3xl md:text-4xl font-medium mb-2 border-b border-solid border-black p-2">Some of our latest quotes:</h1>
        <div class="grid mt-8  gap-8 grid-cols-1 md:grid-cols-2 xl:grid-cols-2">
            @foreach($quotes as $quote)
                <div class="flex flex-col w-full">
                    <div class="bg-white shadow-md  rounded-3xl p-4">
                        <div class="flex-none lg:flex">
                            <div style="min-width:30%;" class="h-full w-full lg:h-48 lg:w-48   lg:mb-0 mb-3">
                                <img style=" max-height: 300px;" src="{{asset($quote->image_src)}}"
                                     alt="Image of {{$quote->author}}" class=" w-full  object-scale-down lg:object-cover  lg:h-48 rounded-2xl">
                            </div>
                            <div class="flex-none ml-3 justify-evenly py-2 h-full p-3">
                                <div class="w-full flex-none text-xs text-blue-700 font-medium ">
                                    <a href="{{route('quote.category', $quote->category_id)}}">{{\App\Models\Category::find($quote->category_id)->title}}</a>
                                </div>
                                <p class="mt-3">"{{Str::limit($quote->quote, 50)}}"</p>
                                <div class="flex py-4  text-sm text-gray-600">
                                    <div class="flex-1 inline-flex justify-between">
                                        <div class="flex">
                                            <p>{{$quote->created_at}}</p>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <span class="mb-2 md:mb-0 bg-white px-5 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2">
                                            <b data-id="{{$quote->id}}"><span class="total{{ $quote->id }} mr-1">{{$quote->count_total_likes()}}</span></b> <span id="total_likes_text{{$quote->id}}">{{ Str::plural('Like', $quote->count_total_likes()) }}</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex p-4 pb-2 border-t border-gray-200 w-full"></div>
                                <div class="flex space-x-3 text-sm font-medium">
                                    <div class="flex-auto flex space-x-3">
                                        @auth
                                            <button id="like{{$quote->id}}" data-id="{{$quote->id}}"
                                                class="mb-2 md:mb-0 bg-white px-5 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2
                                                like @if($quote->is_liked_by_auth_user()) hidden @endif">
                                                <span class="text-red-100 hover:text-red-500 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                      <path data-id="{{$quote->id}}" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                    </svg>
                                                </span>
                                                <span data-id="{{$quote->id}}" class="ml-2">Like</span>
                                            </button>
                                            <button id="unlike{{$quote->id}}" data-id="{{$quote->id}}"
                                                class="mb-2 md:mb-0 bg-white px-5 py-2 shadow-sm tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 inline-flex items-center space-x-2
                                                unlike @if(!$quote->is_liked_by_auth_user()) hidden @endif">
                                                <span class="text-red-600 hover:text-red-700 rounded-lg">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                      <path data-id="{{$quote->id}}" fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                                    </svg>
                                                </span>
                                                <span data-id="{{$quote->id}}" class="ml-2">Unlike</span>
                                            </button>
                                        @endauth
                                    </div>
                                    <button
                                        class="mb-2 md:mb-0 bg-blue-700 px-5 py-2 shadow-sm tracking-wider text-white rounded-full hover:bg-blue-800"
                                    type="button" aria-label="like"><a href="{{ route('quote.single', $quote->id) }}">Read more</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
