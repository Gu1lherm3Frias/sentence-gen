@extends('laravel-usp-theme::master')

@section('content')
    <div>
        <h1>Sentence of the day</h1>
    </div>
    <form method="POST" action="/sentenceofday">
        <button class="btn btn-success" type="submit">Give me a sentence!</button>
    </form>
@endsection