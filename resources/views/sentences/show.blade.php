@extends('laravel-usp-theme::master')

@section('content')
<div class="container py-4" style="min-height: 70vh;">

    <div class="card">
        <div class="card-body">

            <span class="badge bg-info mb-2">
                {{ \App\Services\DateService::numberToDayOfWeek($sentence->date) }}
            </span>

            <h5 class="card-title">{{ $sentence->content }}</h5>

            <p class="text-muted mb-3">
                — {{ $sentence->author ?? 'Desconhecido' }}
            </p>

            <div class="d-flex gap-2">
                <a href="{{ route('sentences.edit', $sentence->id) }}" class="btn btn-primary btn-sm">
                    ✏️ Editar
                </a>

                <form action="{{ route('sentences.destroy', $sentence->id) }}" method="POST">
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
