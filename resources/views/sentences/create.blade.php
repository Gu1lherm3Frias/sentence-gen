@extends('laravel-usp-theme::master')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">➕ Nova Frase</h4>
        <a href="{{ route('sentences.index') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('sentences.store') }}" method="POST">
                @csrf

                {{-- DIA --}}
                <div class="mb-3">
                    <label class="form-label">Dia da semana</label>
                    <select name="date" class="form-control" required>
                        @for($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}">
                                {{ \App\Services\DateService::numberToDayOfWeek($i) }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- CONTEÚDO --}}
                <div class="mb-3">
                    <label class="form-label">Frase</label>
                    <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
                </div>

                {{-- AUTOR --}}
                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="author" class="form-control" required value="{{ old('author') }}">
                </div>

                {{-- BOTÕES --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection