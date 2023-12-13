@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('submit-survey') }}" method="post">
            @csrf
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Ankieta</h5>
                </div>
                <div class="card-body">
                    @foreach ($questions as $index => $question)
                        <div class="form-group">
                            <label for="question{{ $index + 1 }}">Pytanie {{ $index + 1 }}:</label>
                            <p>{{ $question['text'] }}</p>

                            @if ($question['answerType'] === 'singleChoice')
                                <div class="form-check">
                                    @foreach ($question['choices'] as $choice)
                                        <input class="form-check-input" type="radio" name="answer{{ $index }}"
                                               id="choice{{ $loop->index }}" value="{{ $choice['text'] }}" required>
                                        <label class="form-check-label" for="choice{{ $loop->index }}">
                                            {{ $choice['text'] }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            @elseif ($question['answerType'] === 'multiChoice')
                                <div class="form-check">
                                    @foreach ($question['choices'] as $choice)
                                        <input class="form-check-input" type="checkbox" name="answers{{ $index }}[]"
                                               id="choice{{ $loop->index }}" value="{{ $choice['text'] }}">
                                        <label class="form-check-label" for="choice{{ $loop->index }}">
                                            {{ $choice['text'] }}
                                        </label>
                                        <br>
                                    @endforeach
                                </div>
                            @elseif ($question['answerType'] === 'yesNo')
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $index }}" value="Tak" required>
                                    <label class="form-check-label">Tak</label>
                                    <br>
                                    <input class="form-check-input" type="radio" name="answer{{ $index }}" value="Nie" required>
                                    <label class="form-check-label">Nie</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="answer{{ $index }}">Twoja odpowiedź:</label>
                                    <textarea class="form-control" id="answer{{ $index }}" name="answer{{ $index }}"
                                              rows="3" required></textarea>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Wyślij ankietę</button>
        </form>
    </div>
@endsection
