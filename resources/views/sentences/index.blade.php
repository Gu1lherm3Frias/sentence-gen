@extends('laravel-usp-theme::master')

@section('content')
    <div class="container py-4" style="min-height: 70vh;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📖 Todas as Frases</h4>
            <span class="badge bg-secondary">{{ $sentences->count() }} frases</span>
        </div>
        
        @if($sentences->count() > 0)
            <div style="max-height: 500px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 0.25rem; padding: 15px;">
                <div class="row">
                    @foreach($sentences as $sentence)
                        <div class="col-md-6 col-lg-4 mb-3">

                            <a href="{{ route('sentences.show', $sentence->id) }}" 
                               style="text-decoration: none; color: inherit;">

                                <div class="card h-100">
                                    <div class="card-body">
                                        <span class="badge bg-info mb-2">
                                            {{ \App\Services\DateService::numberToDayOfWeek($sentence->date) }}
                                        </span>
                                        
                                        <p class="card-text fst-italic">
                                            "{{ Str::limit($sentence->content, 100) }}"
                                        </p>
                                        
                                        <small class="fw-bold">
                                            — {{ $sentence->author }}
                                        </small>
                                    </div>
                                </div>

                            </a>

                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Nenhuma frase cadastrada ainda!
            </div>
        @endif
    </div>
@endsection