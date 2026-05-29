@extends('laravel-usp-theme::master')

@section('content')
    <div class="container-fluid py-4 mb-5" style="min-height: 70vh;">
        
        <div class="card bg-primary text-white mb-4">
            <div class="card-body text-center p-5">
                <h5 class="card-title mb-3">
                    📅 {{ \App\Services\DateService::numberToDayOfWeek($today) }}
                </h5>
                
                @if($sentenceOfTheDay)
                <blockquote class="mb-3">
                    <p class="lead fst-italic">"{{ $sentenceOfTheDay->content }}"</p>
                    <footer class="text-white-50">{{ $sentenceOfTheDay->author }}</footer>
                </blockquote>
                @else
                <p>Nenhuma frase cadastrada para hoje ainda!</p>
                @endif
                
                <a href='/sentenceOfTheDay' class="btn btn-light">
                    🔄 Nova Frase
                </a>    
            </div>
        </div>
    </div>
@endsection