<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sentence;
use App\Http\Requests\SentenceRequest;

class SentenceController extends Controller
{
    public function randomSentenceOfTheDay() {
        $today = (int) date('N');

        $sentenceOfTheDay = Sentence::where('date', $today)
            ->inRandomOrder()
            ->first();

        return view('sentences.sentenceOfTheDay', compact('sentenceOfTheDay', 'today'));
    }
    
    public function index() {
        $sentences = Sentence::orderBy('date')->get();

        return view('sentences.index', compact('sentences'));
    }

    public function create() {
        return view('sentences.create');
    }

    public function store(SentenceRequest $request) {
        $sentence = new Sentence;
        $sentence->date = $request->date;
        $sentence->content = $request->content;
        $sentence->author = $request->author;
        $sentence->user_id = auth()->user()->id;
        $sentence->save();
        return redirect('/');
    }

    public function show(Sentence $sentence) {
        return view('sentences.show', [
            'sentence' => $sentence
        ]);
    }

    public function edit(Sentence $sentence) {
        return view('sentences.edit', [
            'sentence' => $sentence
        ]);
    }

    public function update(SentenceRequest $request, Sentence $sentence) {
        $sentence->date = $request->date;
        $sentence->content = $request->content;
        $sentence->author = $request->author;
        $sentence->user_id = auth()->user()->id;
        $sentence->save();
        return redirect("/sentences/{$sentence->id}");
    }

    public function destroy(Sentence $sentence) {
        $sentence->delete();
        return redirect('/');
    }

}
