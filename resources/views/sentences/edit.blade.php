@extends('laravel-usp-theme::master')

@section('content')
<div class="container py-4" style="min-height: 70vh;">

    <div class="card">
        <div class="card-body">

            <h4 class="mb-3">✏️ Editar Frase</h4>

            <form action="{{ route('sentences.update', $sentence->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Frase</label>
                    <textarea name="content" class="form-control" rows="3" required>{{ old('content', $sentence->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Autor</label>
                    <input type="text" name="author" class="form-control" value="{{ old('author', $sentence->author) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Dia</label>
                    <select name="date" class="form-control" required>
                        @for($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}" {{ $sentence->date == $i ? 'selected' : '' }}>
                                {{ \App\Services\DateService::numberToDayOfWeek($i) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <!-- Campo de Rating com Slider -->
                <div class="mb-4">
                    <label class="form-label fw-bold">
                        ⭐ Avaliação da Frase 
                        <span class="text-muted" id="ratingValue">0</span>/10
                    </label>
                    
                    <div class="d-flex align-items-center gap-3">
                        <input type="range" 
                               name="rating" 
                               class="form-range" 
                               min="0" 
                               max="10" 
                               step="1"
                               value="{{ old('rating', $sentence->rating ?? 0) }}"
                               oninput="document.getElementById('ratingValue').innerText = this.value">
                    </div>
                    
                    <div class="text-muted small mt-2">
                        Dica: Deslize para avaliar esta frase (0 = péssimo, 10 = excelente)
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-success">
                        💾 Salvar
                    </button>

                    <a href="{{ route('sentences.show', $sentence->id) }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    // Atualiza o valor mostrado ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        const ratingInput = document.querySelector('input[name="rating"]');
        const ratingDisplay = document.getElementById('ratingValue');
        if (ratingInput && ratingDisplay) {
            ratingDisplay.innerText = ratingInput.value;
        }
    });
</script>
@endsection