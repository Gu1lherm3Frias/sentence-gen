@extends('laravel-usp-theme::master')

@section('content')
    <div class="container-fluid py-4 mb-5" style="min-height: 70vh;">
        
        <div class="card bg-primary text-white mb-4">
            <div class="card-body text-center p-5">
                
                @if($sentenceOfTheDay)
                    <!-- Badge de rating no topo -->
                    @php
                        $rating = $sentenceOfTheDay->rating ?? 0;
                        $fullStars = floor($rating / 2);
                        $hasHalfStar = ($rating - ($fullStars * 2)) >= 0.5;
                        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                        $starColor = $rating >= 8 ? '⭐' : ($rating >= 5 ? '🌟' : '💫');
                    @endphp

                    <h5 class="card-title mb-3">
                        📅 {{ \App\Services\DateService::numberToDayOfWeek($today) }}
                    </h5>
                    
                    <blockquote class="mb-3">
                        <p class="lead fst-italic">"{{ $sentenceOfTheDay->content }}"</p>
                        <footer class="text-white-50">{{ $sentenceOfTheDay->author }}</footer>
                    </blockquote>

                    <!-- Nota numérica -->
                    <div class="mb-3">
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                            {{ $starColor }} {{ number_format($rating, 1) }} / 10
                        </span>
                    </div>
                    
                @else
                    <p>Nenhuma frase cadastrada para hoje ainda!</p>
                @endif
                
                <a href='/sentenceOfTheDay' class="btn btn-light mt-2">
                    🔄 Nova Frase
                </a>    
            </div>
        </div>
    </div>
@endsection