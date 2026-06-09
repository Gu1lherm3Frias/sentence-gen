@extends('laravel-usp-theme::master')

@section('content')
<div class="container py-4" style="min-height: 70vh;">

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start mb-2">
                <span class="badge bg-info">
                    {{ \App\Services\DateService::numberToDayOfWeek($sentence->date) }}
                </span>

                @php
                    $rating = $sentence->rating ?? 0;
                    $badgeClass = $rating >= 8 ? 'bg-success' : ($rating >= 5 ? 'bg-warning' : 'bg-danger');
                @endphp

                <span class="badge {{ $badgeClass }}">
                    ⭐ {{ number_format($rating, 1) }}
                </span>
            </div>

            <h5 class="card-title">{{ $sentence->content }}</h5>

            <p class="text-muted mb-3">
                — {{ $sentence->author ?? 'Desconhecido' }}
            </p>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('sentences.edit', $sentence->id) }}" class="btn btn-primary btn-sm">
                    ✏️ Editar
                </a>

                <form action="{{ route('sentences.destroy', $sentence->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        🗑️ Deletar
                    </button>
                </form>

                <a href="{{ route('sentences.index') }}" class="btn btn-secondary btn-sm">
                    ⬅ Voltar
                </a>
            </div>

        </div>
    </div>

</div>
@endsection
