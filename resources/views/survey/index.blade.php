<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Surveys by Kamil Krzywonos</title>
</head>

<body>
    <div class="container" id="app">
        {{ Auth::user()}}
        <form action="{{-- {{ route('submit-survey') }} --}}" method="post">
            @csrf
            <div class="card mt-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">{{ $survey->title }}</h5>
                </div>
                <div class="card-body" style="background-color: #ecf0f1">
                    {{ $survey->description }}
                </div>
            </div>
            @foreach ($questions as $index => $question)
                <div class="card mt-2 mb-3">
                    <div class="card-body" style="background-color: #f5f6fa">
                        <div class="form-group">
                            <label for="question{{ $index + 1 }}">Pytanie {{ $index + 1 }}:
                                <b>{{ $question->content }}</b></label>

                            @if ($question->type === 'singleChoice')
                                @if ($question->options)
                                    <div class="form-check">
                                        @foreach (json_decode($question->options) as $choice)
                                            <input class="form-check-input" type="radio"
                                                name="answer{{ $index }}" id="choice{{ $loop->index }}"
                                                value="{{ $choice->text }}" required>
                                            <label class="form-check-label" for="choice{{ $loop->index }}">
                                                {{ $choice->text }}
                                            </label>
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif ($question->type === 'multiChoice')
                                @if ($question->options)
                                    <div class="form-check">
                                        @foreach (json_decode($question->options) as $choice)
                                            <input class="form-check-input" type="checkbox"
                                                name="answers{{ $index }}[]" id="choice{{ $loop->index }}"
                                                value="{{ $choice->text }}">
                                            <label class="form-check-label" for="choice{{ $loop->index }}">
                                                {{ $choice->text }}
                                            </label>
                                            <br>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif ($question->type === 'yesNo')
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answer{{ $index }}"
                                        value="Tak" required>
                                    <label class="form-check-label">Tak</label>
                                    <br>
                                    <input class="form-check-input" type="radio" name="answer{{ $index }}"
                                        value="Nie" required>
                                    <label class="form-check-label">Nie</label>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="answer{{ $index }}">Twoja odpowiedź:</label>
                                    @if ($question['rules'] && in_array('required', $question['rules']))
                                        <textarea class="form-control" id="answer{{ $index }}" name="answer{{ $index }}" rows="3"
                                            required></textarea>
                                    @else
                                        <input type="text" class="form-control" id="answer{{ $index }}"
                                            name="answer{{ $index }}" required>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            
            <button type="submit" class="btn btn-success mt-3">Wyślij ankietę</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>
