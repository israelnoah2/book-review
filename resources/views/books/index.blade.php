@extends('layout.app')

@section('content')

<h1 class="mb-3 mt-4 text-2xl fw-bold">Books</h1>

<div>

        <form action="{{route('books.index')}}">
          <div class="input-group mb-4">
            <input type="text" placeholder="  What're you searching for?" aria-describedby="button-addon5" class="form-control rounded-0 p-1 border-primary" name="title" value="{{old('title')}}">
            <input type="hidden" name="filter" value="{{ request('filter')}}"/>
            <div class="input-group-append">
              <button id="button-addon5" type="submit" class="btn btn-sm btn-primary rounded-0"><i class="fa fa-search text-primary"></i></button>
            </div>
            <a id="button-addon5" href="{{ route('books.index')}}" class="btn btn-sm btn-primary rounded-0">Clear</a>
          </div>
        </form>

<div class="filter-container mb-4 flex">

@php
  $filters = [
    '' => 'Latest',
    'popular_last_month' => 'Popular Last Month',
    'popular_last_6months' => 'Popular Last 6 Months',
    'highest_rated_last_month' => 'Highest Rated Last Month',
    'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
    ];
@endphp

@foreach ($filters as $key => $label )

<a href="{{route('books.index',[...request()->query(),'filter' => $key])}}" 
   class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
   
   {{ $label }} </a>
  
@endforeach

</div>
        




        <ul class="list-group">

    <!-- <li class="list-group-item">Some content goes here<span class="badge">1</span></li>
    <li class="list-group-item">Some content goes here<span class="badge">2</span></li>
    <li class="list-group-item">Some content goes here<span class="badge">3</span></li>
    <li class="list-group-item">Some content goes here<span class="badge">4</span></li> -->

    @forelse ($books as $book )
    <li class="mb-4">
  <div class="book-item">
    <div
      class="flex flex-wrap items-center justify-between">
      <div class="w-full flex-grow sm:w-auto">
        <a href="{{route('books.show',$book)}}" class="book-title">{{$book->title}}</a>
        <span class="book-author">by {{$book->author}}</span>
      </div>
      <div>
        <div class="book-rating">
          {{number_format($book->reviews_avg_rating,1)}}
        </div>
        <div class="book-review-count">
          out of {{ $book->reviews_count }} {{ Str::plural('review',$book->reviews_count) }}
        </div>
      </div>
    </div>
  </div>
</li>
    @empty
 <li class="mb-4">
  <div class="empty-book-item">
    <p class="empty-text">No books found</p>
    <!-- <a href="#" class="reset-link">Reset criteria</a> -->
  </div>
</li>
    @endforelse
        </ul>

</div>

@endsection